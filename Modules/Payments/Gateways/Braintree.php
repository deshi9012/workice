<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Braintree implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }

    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($transaction->orderId);
        $data          = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }
    public function getData($tr)
    {
        return [
            'invoice_id'     => $this->invoice->id,
            'currency'       => $tr->currencyIsoCode,
            'exchange_rate'  => $this->invoice->exchange_rate,
            'client_id'      => $this->invoice->client_id,
            'project_id' => $this->invoice->project_id,
            'amount'         => $tr->amount,
            'payment_date'   => now()->toDateTimeString(),
            'payment_method' => AcceptPayment::where('method_name', 'Braintree')->first()->method_id,
            'send_email'     => 1,
            'notes'          => 'Paid via Braintree to Merchant Account '.$tr->merchantAccountId,
            'meta'           => [
                'id' => $tr->id, 'status' => $tr->status, 'currency' => $tr->currencyIsoCode,
                'merchantAccountId' => $tr->merchantAccountId
            ],
        ];
    }
}
