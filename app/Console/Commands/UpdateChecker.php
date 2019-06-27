<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Modules\Updates\Events\UpdateAvailable;
use Storage;

class UpdateChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for updates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $updates = collect($this->checkUpdates());
        if (isset($updates['data'])) {
            if (isset($updates['data'][0])) {
                $latest = $updates['data'][0];
                if ($latest->attributes->build > getCurrentVersion()['build'] && settingEnabled('updates_alert')) {
                    Storage::disk('local')->put('updates/update.json', json_encode($latest));
                    $sentBuild = getLastReminder();
                    if ($latest->attributes->build > $sentBuild) {
                        event(new UpdateAvailable($latest));
                        Storage::disk('local')->put('updates/last_reminder.json', $latest->attributes->build);
                    }
                }
            }
        }
        $this->info('Update check completed');
    }

    protected function checkUpdates()
    {
        try {
            $client = new Client();
            $output = $client->get('https://desk.workice.com/api/v1/updates')->getBody();
        } catch (\Exception $e) {
            return [];
        }
        return json_decode($output);
    }
}
