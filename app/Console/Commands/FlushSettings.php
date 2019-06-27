<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FlushSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush cached system settings';

    /**
     * Create a new command instance.
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
        Cache::forget(settingsCacheName());
        $this->info('Settings flushed successfully');
    }
}
