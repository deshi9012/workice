<?php

namespace Modules\Estimates\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Estimates\Entities\Estimate;
use Modules\Estimates\Notifications\EstimateOverdueAlert;

class EstimateReminderJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $estimates;
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
        $this->estimates = Estimate::reminderAlerts()->get();
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function handle()
    {
        if (settingEnabled('autoremind_estimates')) {
            $this->estimates->each(
                function ($estimate) {
                    $estimate->company->notify(new EstimateOverdueAlert($estimate));
                    $estimate->update(['reminded_at' => now()->toDateTimeString()]);
                }
            );
        }
    }
}
