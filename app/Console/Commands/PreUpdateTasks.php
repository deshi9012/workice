<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PreUpdateTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pre-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to execute before an update';

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
        // backup files and DB
        $this->call('backup:run', ['--only-db' => true]);
        $this->call('backup:run', ['--only-files' => true]);
    }
}
