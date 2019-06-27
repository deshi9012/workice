<?php

namespace Modules\Invoices\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Notifications\InvoiceOverdueAlert;

class InvoiceReminderJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoices;
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
        $this->invoices = Invoice::reminderAlerts()->get();
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function handle()
    {
        $this->invoices->each(
            function ($invoice) {
                $invoice->company->notify(new InvoiceOverdueAlert($invoice));
                $invoice->update(['reminded_at' => now()->toDateTimeString()]);
            }
        );
    }
}
