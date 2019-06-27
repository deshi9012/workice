<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Settings\Entities\Options;

class DemoMode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:demo {switch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to activate/deactivate demo mode';

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
        $switch = $this->argument('switch');
        if ($switch === 'on') {
            update_option('demo_mode', 'TRUE');
            \Cache::forget(settingsCacheName());
            $this->info('Demo mode activated');
        } else {
            update_option('demo_mode', 'FALSE');
            \Cache::forget(settingsCacheName());
            $this->info('Demo mode deactivated');
        }
    }
}
