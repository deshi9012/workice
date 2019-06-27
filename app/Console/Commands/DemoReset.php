<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DemoReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to restore backup from the selected demo sql file';

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
        if (isDemo()) {
            $this->call('down');
            $this->call('cache:clear');
            $this->call('app:flush');
            $this->call('backup:mysql-restore', ['--filename' => 'demo.sql', '--yes' => true]);
            $this->call('up');
            $this->call('app:balances');
            $this->call('analytics:compute');
            $this->call('deals:velocity');
            $this->call('deals:forecast');
            $this->info('✔︎ Demo data was reset successfully');
        } else {
            $this->info('✗ Application is not in demo mode');
        }
    }
}
