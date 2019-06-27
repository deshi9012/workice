<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;
use Modules\Settings\Entities\Options;
use Modules\Users\Entities\User;

class ResetApplicationData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets application database to blank state';

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
        $cache = cache(settingsCacheName());
        if (count($cache) > 0) {
            $this->info('✔︎ Performing fresh migration...');
            Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
            Options::truncate();
            foreach ($cache as $key => $value) {
                update_option($key, $value);
            }
            $this->info('✔︎ Restored previous settings');
            Artisan::call('passport:install');
            $this->info('✔︎ Creating super admin');
            $user = User::create([
                'email'             => 'admin@example.com',
                'email_verified_at' => now(),
                'name'              => 'John Doe',
                'password'          => 'admin',
            ]);
            $user->syncRoles('admin');
            $this->info('✔︎ Database cleaned successfully. Login using admin@example.com/admin');
        } else {
            $this->error('✗ Your config is not loaded');
        }
    }
}
