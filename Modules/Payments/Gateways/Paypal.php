<?php

namespace Modules\Payments\Gateways;

use App\Entities\AcceptPayment;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Contracts\PaymentInterface;
use Modules\Payments\Helpers\Cashier;

class Paypal implements PaymentInterface
{
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    
    public function pay($transaction)
    {
        $this->invoice = $this->invoice->findOrFail($transaction['item_number']);
        $data = $this->getData($transaction);
        return (new Cashier($data, $this->invoice))->save();
    }

    

    public function getData($transaction)
    {
        return [
                'invoice_id' => $this->invoice->id,
                'currency' => $transaction['mc_currency'],
                'exchange_rate' => $this->invoice->exchange_rate,
                'client_id' => $this->invoice->client_id,
                'project_id' => $this->invoice->project_id,
                'amount' => $transaction['mc_gross'],
                'payment_date' => $transaction['payment_date'],
                'payment_method' => AcceptPayment::where('method_name', 'paypal')->first()->method_id,
                'send_email' => 1,
                'notes' => 'Paid by ' . $transaction['first_name'] . ' ' . $transaction['last_name'],
                'meta'           => [
                    'payer_email' => $transaction['payer_email'], 'txn_id'         => $transaction['txn_id'],
                    'verify_sign' => $transaction['verify_sign'], 'item_name'      => $transaction['item_name'],
                    'mc_currency' => $transaction['mc_currency'], 'receiver_email' => $transaction['receiver_email'],
                    'item_number' => $transaction['item_number'],
                ],
        ];
    }
}
