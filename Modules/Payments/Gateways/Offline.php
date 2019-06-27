<?php

namespace Modules\Payments\Gateways;

use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Offline implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    
    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($transaction['invoice_id']);
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
                'amount' => $transaction['amount'],
                'payment_date' => $transaction['payment_date'],
                'payment_method' => $transaction['payment_method'],
                'send_email' => isset($transaction['send_email']) ? $transaction['send_email'] : 0,
                'notes' => isset($transaction['notes']) ? $transaction['notes'] : '',
                'meta' => []
        ];
    }
}
