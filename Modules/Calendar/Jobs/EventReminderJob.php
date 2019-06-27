<?php

namespace Modules\Calendar\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Calendar\Entities\Calendar;
use Modules\Calendar\Notifications\EventAlert;
use Modules\Users\Entities\User;

class EventReminderJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $events;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;
    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $events = Calendar::reminderAlerts()->get();
        foreach ($events as $event) {
            if (strtotime($event->start_date) <= now()->addMinutes($event->alert)->timestamp) {
                if (count((array) $event->attendees)) {
                    foreach (User::whereIn('id', $event->attendees)->get() as $user) {
                        $user->notify(new EventAlert($event));
                    }
                    $event->update(['alerted_at' => now(), 'alert_sent' => 1]);
                }
            }
        }
    }
}
