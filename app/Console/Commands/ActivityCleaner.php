<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Activity\Entities\Activity;

class ActivityCleaner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:activities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean user activities older than x days';

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
        $activities = Activity::whereDate('created_at', '<', now()->subDays(config('system.activity_days')))->get();
        foreach ($activities as $activity) {
            $activity->delete();
        }
        $this->info('User activities cleaned successfully');
    }
}
