<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Stripe implements PaymentInterface
{
    protected $invoice;
    protected $metadata;

    public function __construct()
    {
        $this->invoice = new Invoice;
        $this->metadata = [];
    }
    
    public function pay($transaction)
    {
        $this->metadata = $transaction->metadata;
        $this->invoice = $this->invoice->findOrFail($this->metadata->invoice_id);
        $data = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }

    public function getData($charge)
    {
        return [
                'invoice_id' => $this->metadata->invoice_id,
                'currency' => strtoupper($charge->currency),
                'exchange_rate' => $this->invoice->exchange_rate,
                'client_id' => $this->invoice->client_id,
                'project_id' => $this->invoice->project_id,
                'amount' => $charge->amount / 100,
                'payment_date' => now()->toDateTimeString(),
                'payment_method' => AcceptPayment::where('method_name', 'stripe')->first()->method_id,
                'send_email' => 1,
                'notes' => 'Paid via Stripe by '.$this->metadata->payer,
                'meta'           => [
                    'payer_email' => $this->metadata->payer_email, 'txn_id' => $charge->balance_transaction,
                    'invoice_code' => $this->metadata->code
                ],
        ];
    }
}
