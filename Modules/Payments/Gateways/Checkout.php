<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Checkout implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    
    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($transaction['response']['merchantOrderId']);
        $data = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }

    public function getData($transaction)
    {
        return [
                'invoice_id' => $this->invoice->id,
                'currency' => $transaction['response']['currencyCode'],
                'exchange_rate' => $this->invoice->exchange_rate,
                'client_id' => $this->invoice->client_id,
                'project_id' => $this->invoice->project_id,
                'amount' => $transaction['response']['total'],
                'payment_date' => now()->toDateTimeString(),
                'payment_method' => AcceptPayment::where('method_name', '2checkout')->first()->method_id,
                'send_email' => 1,
                'notes' => 'Paid via 2checkout',
                'meta'           => [
                        'transactionId' => $transaction['response']['transactionId'], 'orderNumber' => $transaction['response']['orderNumber'],
                        'responseMsg' => $transaction['response']['responseMsg']
                    ],
        ];
    }
}
