<?php

namespace Modules\Deals\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Deals\Entities\Deal;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Jobs\CalculateInvoice;

class InvoiceDealJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $deal;

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
    public function __construct(Deal $deal)
    {
        $this->deal = $deal;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invoice = Invoice::create(
            [
                'client_id'    => $this->deal->organization,
                'reference_no' => generateCode('invoices'),
                'currency'     => $this->deal->currency,
                'due_date'     => now()->addDays(get_option('invoices_due_after', '30'))->toDateTimeString(),
            ]
        );
        foreach ($this->deal->items as $item) {
            $invoice->items()->create($item->toArray());
        }
        CalculateInvoice::dispatch($invoice)->onQueue('high');
    }
}
