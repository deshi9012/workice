<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Wepay implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    
    public function pay($transaction)
    {
        $reference = json_decode($transaction->reference_id);
        $this->invoice = $this->invoice->findOrFail($reference->invoice_id);
        $data = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }

    public function getData($payment)
    {
        return [
                'invoice_id' => $this->invoice->id,
                'currency' => $payment->currency,
                'exchange_rate' => $this->invoice->exchange_rate,
                'client_id' => $this->invoice->client_id,
                'project_id' => $this->invoice->project_id,
                'amount' => $payment->amount,
                'payment_date' => now()->createFromTimestamp($payment->create_time)->toDateTimeString(),
                'payment_method' => AcceptPayment::where('method_name', 'WePay')->first()->method_id,
                'send_email' => 1,
                'notes' => $payment->short_description,
                'meta'           => [
                    'checkout_id' => $payment->checkout_id, 'account_id' => $payment->account_id,
                    'state' => $payment->state, 'gross' => $payment->gross, 'fee' => $payment->fee->processing_fee,
                    'payer' => $payment->payer->email, 'soft_descriptor' => $payment->soft_descriptor
                ],
        ];
    }
}
