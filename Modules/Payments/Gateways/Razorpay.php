<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Razorpay implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    
    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($transaction->notes->invoice_id);
        $data = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }
    
    public function getData($payment)
    {
        $amountInr = $payment->amount / 100;
        $paidAmount = convertCurrency($payment->currency, $amountInr, $this->invoice->currency);
        return [
                'invoice_id' => $payment->notes->invoice_id,
                'currency' => strtoupper($this->invoice->currency),
                'exchange_rate' => $this->invoice->exchange_rate,
                'client_id' => $this->invoice->client_id,
                'project_id' => $this->invoice->project_id,
                'amount' => $paidAmount,
                'payment_date' => now()->toDateTimeString(),
                'payment_method' => AcceptPayment::where('method_name', 'Razorpay')->first()->method_id,
                'send_email' => 1,
                'notes' => 'Paid via Razorpay by '.$payment->card->name,
                'meta'           => [
                    'description' => $payment->description, 'currency' => $payment->currency, 'method' => $payment->method,
                    'id' => $payment->id, 'amount' => $payment->amount, 'email'=> $payment->email,
                    'fee' => $payment->fee, 'created_at' => $payment->created_at
                ],
        ];
    }
}
