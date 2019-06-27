<?php

namespace Modules\Contracts\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Contracts\Entities\Contract;
use Modules\Contracts\Notifications\ContractOverdueAlert;

class ContractReminderJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contracts;
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
        $this->contracts = Contract::reminderAlerts()->get();
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function handle()
    {
        if (config('system.autoremind_contracts')) {
            $this->contracts->each(
            function ($contract) {
                $contract->company->notify(new ContractOverdueAlert($contract));
                $contract->update(['reminded_at' => now()->toDateTimeString()]);
            }
        );
        }
    }
}
