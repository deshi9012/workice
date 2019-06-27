<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestingInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create installed file in storage/app DIR';

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
        $installedLogFile = storage_path('installed');

        $dateStamp = date("Y/m/d h:i:sa");

        if (!file_exists($installedLogFile)) {
            $message = 'Workice successfully installed on ' . $dateStamp . "\n";

            file_put_contents($installedLogFile, $message);
        } else {
            $message = 'Workice successfully updated on ' . $dateStamp;

            file_put_contents($installedLogFile, $message . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }
}
