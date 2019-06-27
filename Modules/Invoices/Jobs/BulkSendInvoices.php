<?php

namespace Modules\Invoices\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Emails\InvoiceMail;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Events\InvoiceSent;

class BulkSendInvoices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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

    protected $arr;
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $arr, $user)
    {
        $this->arr    = $arr;
        $this->userId = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invoices = Invoice::whereIn('id', $this->arr)->get();
        foreach ($invoices as $invoice) {
            \Mail::to($invoice->company)->send(new InvoiceMail($invoice));
            event(new InvoiceSent($invoice, $this->userId));
        }
    }
}
