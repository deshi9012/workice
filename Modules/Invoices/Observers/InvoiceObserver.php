<?php

namespace Modules\Invoices\Observers;

use App\Traits\Taggable;
use Modules\Clients\Entities\Client;
use Modules\Clients\Jobs\ClientBalance;
use Modules\Expenses\Entities\Expense;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Jobs\CalculateInvoice;

class InvoiceObserver
{
    use Taggable;
    /**
     * Listen to the Invoice created event.
     *
     * @param \Modules\Invoices\Entities\Invoice $invoice
     */
    public function creating(Invoice $invoice)
    {
        if (!is_numeric($invoice->client_id)) {
            $invoice->client_id = Client::firstOrCreate(
                ['email' => $invoice->client_id],
                ['owner' => \Auth::id(), 'name' => $invoice->client_id]
            )->id;
        }
        $invoice->is_visible = empty($invoice->is_visible) ? 0 : $invoice->is_visible;

        if (empty($invoice->due_date) || is_null($invoice->due_date)) {
            $invoice->due_date = now()->addDays(get_option('invoices_due_after', '15'))->toDateTimeString();
        }
        $invoice->exchange_rate = xchangeRate($invoice->currency);
        if (empty($invoice->reference_no) || settingEnabled('increment_invoice_number')) {
            $invoice->reference_no = generateCode('invoices');
        }
    }

    /**
     * Listen to the Invoice updated event.
     *
     * @param \Modules\Invoices\Entities\Invoice $invoice
     */
    public function updated(Invoice $invoice)
    {
        if ($invoice->hasPayment()) {
            $invoice->payments()->update(['client_id' => $invoice->client_id]);
        }
    }

    /**
     * Listen to the Invoice saved event.
     *
     * @param \Modules\Invoices\Entities\Invoice $invoice
     */
    public function saved(Invoice $invoice)
    {
        $invoice->saveInstallments();
        if (request()->has('tags')) {
            $invoice->retag(collect(request('tags'))->implode(','));
        }
        CalculateInvoice::dispatch($invoice)->onQueue('high');
        ClientBalance::dispatch($invoice->company)->onQueue('high');
        $invoice->saveCustom(request('custom'));
    }

    /**
     * Listen to the Invoice deleting event.
     *
     * @param \Modules\Invoices\Entities\Invoice $invoice
     */
    public function deleting(Invoice $invoice)
    {
        $invoice->items()->each(
            function ($item) {
                $item->delete();
            }
        );
        $invoice->payments()->each(
            function ($payment) {
                $payment->delete();
            }
        );
        $invoice->credited()->each(
            function ($cr) {
                $cr->delete();
            }
        );

        $invoice->installments()->each(
            function ($installment) {
                $installment->delete();
            }
        );

        $invoice->activities()->each(
            function ($log) {
                $log->delete();
            }
        );

        $invoice->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );
        $invoice->schedules()->each(
            function ($event) {
                $event->delete();
            }
        );
        $invoice->tags()->each(
            function ($tag) {
                $tag->delete();
            }
        );
        $invoice->recurring()->delete();

        Expense::whereInvoicedId($invoice->id)->update(['invoiced_id' => null]);
    }
}
