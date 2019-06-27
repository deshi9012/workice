<?php

namespace Modules\Invoices\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Entities\Invoice;

class CalculateInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoice;
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
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->invoice->unsetEventDispatcher();
        $this->invoice->compute();
    }
}
