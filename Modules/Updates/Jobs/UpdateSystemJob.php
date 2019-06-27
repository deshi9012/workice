<?php

namespace Modules\Updates\Jobs;

use Artisan;
use File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Modules\Updates\Events\LatestVersion;
use Modules\Updates\Events\UpdateFailed;
use Modules\Updates\Events\UpdateRestored;
use Modules\Updates\Events\UpdateRestoreFailed;
use Modules\Updates\Events\UpdateSuccessful;
use Storage;

class UpdateSystemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 180;

    protected $tmp_backup_dir = null;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Artisan::call('app:pre-update');
        Artisan::call('app:updates');

        $this->update();

        Artisan::call('app:post-update');
    }

    /*
     * Download and Install Update.
     */
    public function update()
    {
        if (!$this->checkPermission()) {
            Log::error(trans("updates.action_not_allowed"));
            event(new UpdateFailed($this->user));
            throw new \Exception(trans("updates.action_not_allowed"));
        }
        $latestVersion = getLastVersion();
        if ($latestVersion['attributes']['build'] <= getCurrentVersion()['build']) {
            Log::info(trans("updates.your_system_is_up_to_date"));
            event(new LatestVersion($this->user));
            return;
            // throw new \Exception(trans("updates.your_system_is_up_to_date"));
        }
        try {
            $this->tmp_backup_dir = storage_path('app/updates/backup_' . date('Ymd'));

            Log::info(trans("updates.update_found") . ' : v' . $latestVersion['attributes']['version']);
            Log::info(trans("updates.downloading_update"));
            $update_path = null;
            if (($update_path = $this->download($latestVersion['attributes']['filename'])) === false) {
                Log::error(trans("updates.error_during_download"));
                event(new UpdateFailed($this->user));
                throw new \Exception(trans("updates.error_during_download"));
            }
            Log::info(trans("updates.ok"));
            Artisan::call('down');
            Log::info(trans("updates.maintenance_mode_activated"));
            $status = $this->install($latestVersion['attributes']['version'], $update_path, $latestVersion['attributes']['filename']);

            if ($status) {
                Artisan::call('migrate', ['--force' => true]);
                Log::info(trans("updates.database_migrated"));
                Artisan::call('up');
                Log::info(trans("updates.maintenance_mode_deactivated"));
                Log::info(trans("updates.system_updated_to_version") . ' v: ' . $latestVersion['attributes']['version']);
                Storage::disk('local')->put('version.json', json_encode([
                    'version' => $latestVersion['attributes']['version'],
                    'build'   => $latestVersion['attributes']['build'],
                ]));
                event(new UpdateSuccessful($this->user));
            } else {
                Log::error(trans("updates.error_during_download"));
                event(new UpdateFailed($this->user));
                throw new \Exception(trans("updates.error_during_download"));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error(trans("updates.error_during_update"));
            event(new UpdateFailed($this->user));
            $this->restore();
        }
    }

    private function checkPermission()
    {
        if (config('updater.allow_users_id') !== null) {
            if (config('updater.allow_users_id') === false) {
                return true;
            }
            if (in_array($this->user, config('updater.allow_users_id')) === true) {
                return true;
            }
        }
        return false;
    }

    private function install($lastVersion, $update_path, $archive)
    {
        try {
            $zipHandle = zip_open($update_path);
            $archive   = substr($archive, 0, -4);
            Log::info('------------ ' . trans('updates.changelog') . '----------------');
            while ($zip_item = zip_read($zipHandle)) {
                $filename = zip_entry_name($zip_item);
                $dirname  = dirname($filename);
                // Exclude these cases (1/2)
                if (substr($filename, -1, 1) == '/' || dirname($filename) === $archive || substr($dirname, 0, 2) === '__') {
                    continue;
                }
                // Exclude root folder (if exist)
                if (substr($dirname, 0, strlen($archive)) === $archive) {
                    $dirname = substr($dirname, (strlen($dirname) - strlen($archive) - 1) * (-1));
                }
                // Exclude these cases (2/2)
                // todo:check linux and windows test
                //if($dirname === '.' ) continue;
                $filename = $dirname . '/' . basename($filename); //set new purify path for current file
                if (!is_dir(base_path() . '/' . $dirname)) {
                    //Make NEW directory (if exist also in current version continue...)
                    File::makeDirectory(base_path() . '/' . $dirname, $mode = 0755, true, true);
                    Log::info('✔︎ ' . trans("updates.directory") . ' => ' . $dirname . '......... [ ' . trans("updates.ok") . ' ]');
                }
                if (!is_dir(base_path() . '/' . $filename)) {
                    // Overwrite a file with its last version
                    $contents = zip_entry_read($zip_item, zip_entry_filesize($zip_item));
                    $contents = str_replace("\r\n", "\n", $contents);

                    Log::info('✔︎ ' . trans("updates.file") . ' => ' . $filename . ' ........... ' . '[ ' . trans("updates.ok") . ' ]');
                    if (File::exists(base_path() . '/' . $filename)) {
                        $this->backup($filename);
                    } //backup current version
                    File::put(base_path() . '/' . $filename, $contents);
                    unset($contents);
                }
            }
            zip_close($zipHandle);
            File::delete($update_path); // clean TMP
            File::deleteDirectory($this->tmp_backup_dir); // remove backup temp folder
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return true;
    }
    /*
     * Download Update from $update_baseurl to $tmp_path (local folder).
     */
    private function download($filename)
    {
        try {
            $filename_tmp = storage_path(config('updater.tmp_path') . '/' . $filename);
            if (is_file($filename_tmp)) {
                File::delete($filename_tmp);
            }
            $code = get_option('purchase_code');
            $url  = config('updater.update_baseurl') . '/' . $code . '/' . $filename;
            $fp   = fopen($filename_tmp, 'w+');
            if ($fp === false) {
                Log::error(trans("updates.could_not_save_update"));
                throw new \Exception('Could not open: ' . $filename_tmp);
            }
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_exec($ch);
            if (curl_errno($ch)) {
                Log::error(trans("updates.could_not_save_update"));
                throw new \Exception(curl_error($ch));
            }
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            fclose($fp);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $filename_tmp;
    }

    /*
     * Check if a new Update exist.
     */
    public function check()
    {
        $lastVersionInfo = getLastVersion();
        if (version_compare($lastVersionInfo['attributes']['version'], getCurrentVersion()['version'], ">")) {
            return $lastVersionInfo['attributes']['version'];
        }
        return '';
    }

    public function backup($filename)
    {
        $backup_dir = $this->tmp_backup_dir;
        if (!is_dir($backup_dir)) {
            File::makeDirectory($backup_dir, $mode = 0755, true, true);
        }
        if (!is_dir($backup_dir . '/' . dirname($filename))) {
            File::makeDirectory($backup_dir . '/' . dirname($filename), $mode = 0755, true, true);
        }
        File::copy(base_path() . '/' . $filename, $backup_dir . '/' . $filename); //to backup folder
    }
    public function restore()
    {
        if (!isset($this->tmp_backup_dir)) {
            $this->tmp_backup_dir = storage_path('app/updates/backup_' . date('Ymd'));
        }
        try {
            $backup_dir   = $this->tmp_backup_dir;
            $backup_files = File::allFiles($backup_dir);
            foreach ($backup_files as $file) {
                $filename = (string) $file;
                $filename = substr($filename, (strlen($filename) - strlen($backup_dir) - 1) * (-1));
                Log::info($backup_dir . '/' . $filename . " => " . base_path() . '/' . $filename);
                File::copy($backup_dir . '/' . $filename, base_path() . '/' . $filename); //to respective folder
            }
        } catch (\Exception $e) {
            event(new UpdateRestoreFailed($this->user));
            Log::error("Exception => " . $e->getMessage());
            Log::error(trans("updates.failed"));
            Log::error(trans("updates.backup_folder_located_in") . " <i>" . $backup_dir . "</i>");
            Log::error(trans("updates.restore_system_command") . " <i>php artisan up</i>");
            return false;
        }

        Log::info("[ " . trans("updates.restored") . " ]");
        event(new UpdateRestored($this->user));
        return true;
    }
}
