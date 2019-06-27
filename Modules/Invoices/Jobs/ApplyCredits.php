<?php

namespace Modules\Invoices\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Jobs\CalculateInvoice;

class ApplyCredits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoice;

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
        foreach ($this->invoice->company->credits()->open()->get() as $credit) {
            if ($credit->balance > 0 && $this->invoice->due() > 0) {
                if ($credit->balance > $this->invoice->due()) {
                    $credit->credited()->create([
                        'invoice_id' => $this->invoice->id, 'credited_amount' => $this->invoice->due(),
                    ]);
                } else {
                    $credit->credited()->create([
                        'invoice_id' => $this->invoice->id, 'credited_amount' => $credit->balance,
                    ]);
                }
                CalculateInvoice::dispatch($this->invoice)->onQueue('high');
            }
        }
    }
}
