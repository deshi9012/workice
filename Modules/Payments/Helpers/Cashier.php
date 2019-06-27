<?php

namespace Modules\Payments\Helpers;

use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Notifications\InvoiceOverpaid;
use Modules\Payments\Entities\Payment;
use Modules\Users\Entities\User;

class Cashier
{
    public $payment;
    public $tx;
    public $invoice;
    public $paid;

    public function __construct(array $transaction, Invoice $invoice)
    {
        $this->tx      = $transaction;
        $this->invoice = $invoice;
    }

    public function save()
    {
        // When paid amount is greater than invoice balance notify company contact
        if ($this->tx['amount'] > $this->invoice->due() && !app()->runningUnitTests()) {
            \Notification::send(User::role('admin')->first(), new InvoiceOverpaid($this->invoice, $this->tx['amount']));
            return;
        }

        // Check if invoice has installments
        if ($this->invoice->installments->count() > 1) {
            $amount = $this->tx['amount'];
            // Loop through installments
            foreach ($this->invoice->installments as $key => $partial) {
                $this->paid = [];
                // Check if installment has balance
                if ($partial->balance() > 0) {
                    if ($amount <= $partial->balance()) {
                        if ($amount > 0) {
                            $this->payment               = $this->txData();
                            $this->payment['amount']     = $amount;
                            $this->payment['partial_id'] = $partial->id;
                            $this->paid                  = Payment::create($this->payment);
                        }
                        // unset the amount to prevent insertion of negative payments
                        $amount = 0;
                    } else {
                        // subtract partial amount
                        $amount                      = $amount - $partial->balance();
                        $this->payment               = $this->txData();
                        $this->payment['amount']     = $partial->balance();
                        $this->payment['partial_id'] = $partial->id;
                        $this->paid                  = Payment::create($this->payment);
                    }
                }
            }
        } else {
            $this->payment               = $this->txData();
            $this->payment['partial_id'] = 0;
            return Payment::create($this->payment);
        }
        return $this->paid;
    }

    private function txData()
    {
        $this->payment                   = [];
        $this->payment['code']           = generateCode('payments');
        $this->payment['invoice_id']     = $this->tx['invoice_id'];
        $this->payment['currency']       = $this->tx['currency'];
        $this->payment['client_id']      = $this->tx['client_id'];
        $this->payment['amount']         = $this->tx['amount'];
        $this->payment['project_id']     = $this->tx['project_id'];
        $this->payment['payment_date']   = $this->tx['payment_date'];
        $this->payment['payment_method'] = $this->tx['payment_method'];
        $this->payment['notes']          = $this->tx['notes'];
        $this->payment['meta']           = $this->tx['meta'];
        $this->payment['send_email']     = $this->tx['send_email'];
        $this->payment['exchange_rate']  = $this->tx['exchange_rate'];
        return $this->payment;
    }
}
