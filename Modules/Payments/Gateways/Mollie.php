<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Mollie implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    
    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($transaction->metadata->invoice_id);
        $data = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }

    public function getData($payment)
    {
        return [
                'invoice_id' => $this->invoice->id,
                'currency' => $payment->amount->currency,
                'exchange_rate' => $this->invoice->exchange_rate,
                'client_id' => $this->invoice->client_id,
                'project_id' => $this->invoice->project_id,
                'amount' => $payment->amount->value,
                'payment_date' => $payment->paidAt,
                'payment_method' => AcceptPayment::where('method_name', 'mollie')->first()->method_id,
                'send_email' => 1,
                'notes' => $payment->description,
                'meta'           => [
                    'profileId' => $payment->profileId, 'status'         => $payment->status
                ],
        ];
    }
}
