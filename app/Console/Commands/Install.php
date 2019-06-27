<?php

namespace App\Console\Commands;

use App\Entities\Currency;
use DB;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Users\Entities\User;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workice:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Workice CRM';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $version = getCurrentVersion()['version'];
        try {
            DB::connection();
        } catch (Exception $e) {
            $this->error('Unable to connect to database.');
            $this->error('Please fill valid database credentials into .env and rerun this command.');

            return;
        }

        $this->comment('--------------------');
        $this->comment('Attempting to install Workice v' . $version);
        $this->comment('--------------------');

        if (!env('APP_KEY')) {
            $this->info('Generating app key');
            Artisan::call('key:generate');
        } else {
            $this->info('App key exists -- skipping');
        }

        $this->info('Migrating database.');
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('passport:install');
        $this->info('✔︎ Database successfully migrated.');

        if (!Currency::count()) {
            $this->info('Seeding Database data');
            Artisan::call('db:seed', ['--force' => true]);
            $this->info('✔︎ Data successfully seeded');
        } else {
            $this->info('Data already seeded.');
        }

        $this->info('Creating symbolic link.');
        Artisan::call('storage:link');
        $this->info('✔︎ Symlink created.');

        $this->info('Clearing Cache');
        Artisan::call('cache:clear');
        $this->info('✔︎ Cache cleared successfully');

        /*
         * If there is no account prompt the user to create one;
         */
        if (User::count() === 0) {
            DB::beginTransaction();
            try {
                $this->comment('--------------------');
                $this->comment('Please create an admin account');
                $this->comment('--------------------');
                //Create the first user
                $name     = $this->ask('Enter full name');
                $jobtitle = $this->ask('Enter your Job Title');
                $email    = $this->ask('Enter your email');
                $password = $this->secret('Enter new admin password');

                $user_data['email']             = $email;
                $user_data['username']          = $email;
                $user_data['name']              = $name;
                $user_data['password']          = $password;
                $user_data['email_verified_at'] = now();
                $user                           = User::create($user_data);

                $account_data['job_title'] = $jobtitle;
                $account                   = $user->profile->update($account_data);

                DB::commit();
                $user->syncRoles('admin');

                $this->info('✔︎ Admin account successfully created');
            } catch (Exception $e) {
                DB::rollBack();
                $this->error('Error Creating User');
                $this->error($e);
            }
        }
        $dateStamp = date("Y/m/d h:i:sa");
        $message   = 'Workice successfully installed on ' . $dateStamp . "\n";

        file_put_contents(storage_path('installed'), $message);

        $this->comment(
            "
 _    _               _     _
| |  | |             | |   (_)
| |  | |  ___   _ __ | | __ _   ___   ___
| |/\| | / _ \ | '__|| |/ /| | / __| / _ \
\  /\  /| (_) || |   |   < | || (__ |  __/
 \/  \/  \___/ |_|   |_|\_\|_| \___| \___|
"
        );

        $this->comment('✔︎ Good Job! Thank you for installing Workice CRM');
    }
}
