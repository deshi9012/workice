<?php

namespace Modules\Calendar\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Calendar\Entities\Appointment;
use Modules\Calendar\Notifications\AppointmentAlert;

class AppointmentReminderJob
{
    use Dispatchable, InteractsWithQueue, Queueable;
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
     * Send reminders for each appointment
     *
     * @return void
     */
    public function handle()
    {
        $appointments = Appointment::reminderAlerts()->get();
        foreach ($appointments as $appointment) {
            if (strtotime($appointment->start_time) <= now()->addMinutes($appointment->alert)->timestamp) {
                $appointment->user->notify(new AppointmentAlert($appointment));
                if ($appointment->attendee_id != $appointment->user_id) {
                    $appointment->attendee->notify(new AppointmentAlert($appointment));
                }
                $appointment->update(['reminded_at' => now()->toDateTimeString()]);
            }
        }
    }
}
