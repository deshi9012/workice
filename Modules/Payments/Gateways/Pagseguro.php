<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Pagseguro implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    
    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($transaction['reference']);
        $data = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }

    

    public function getData($transaction)
    {
        return [
                'invoice_id' => $this->invoice->id,
                'currency' => $this->invoice->currency,
                'exchange_rate' => $this->invoice->exchange_rate,
                'client_id' => $this->invoice->client_id,
                'project_id' => $this->invoice->project_id,
                'amount' => $transaction['grossAmount'],
                'payment_date' => $transaction['date'],
                'payment_method' => AcceptPayment::firstOrCreate(['method_name' => 'Pagseguro'])->method_id,
                'send_email' => 1,
                'notes' => 'Paid by ' . $transaction['sender']['name'],
                'meta'           => [
                    'sender_email' => $transaction['sender']['email'], 'code'         => $transaction['code'],
                    'payment_method' => $transaction['paymentMethod']['type'], 'payment_method_code'      => $transaction['paymentMethod']['code'],
                    'net_amount' => $transaction['netAmount'],'type' => $transaction['type'],
                    'reference' => $transaction['reference']
                ],
        ];
    }
}
