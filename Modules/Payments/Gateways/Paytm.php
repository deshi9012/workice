<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Paytm implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }

    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($this->getInvoiceId($transaction['ORDERID']));
        $data          = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }

    public function getData($transaction)
    {
        return [
            'invoice_id'     => $this->invoice->id,
            'currency'       => $this->invoice->currency,
            'exchange_rate'  => $this->invoice->exchange_rate,
            'client_id'      => $this->invoice->client_id,
            'project_id'     => $this->invoice->project_id,
            'amount'         => $transaction['TXNAMOUNT'],
            'payment_date'   => $transaction['TXNDATE'],
            'payment_method' => AcceptPayment::firstOrCreate(['method_name' => 'paytm'])->method_id,
            'send_email'     => 1,
            'notes'          => 'Transaction ID ' . $transaction['TXNID'],
            'meta'           => [
                'status'  => $transaction['STATUS'], 'order_id'      => $transaction['ORDERID'],
                'gateway' => $transaction['GATEWAYNAME'], 'respcode' => $transaction['RESPCODE'],
            ],
        ];
    }
    public function getInvoiceId($orderId)
    {
        return (int) substr($orderId, 0, strpos($orderId, "-"));
    }
}
