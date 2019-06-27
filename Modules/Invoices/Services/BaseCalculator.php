<?php

namespace Modules\Invoices\Services;

use Modules\Invoices\Entities\Invoice;

abstract class BaseCalculator
{
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function subTotal()
    {
        return formatDecimal($this->invoice->items->sum('total_cost'));
    }

    public function creditedAmount()
    {
        return $this->invoice->credited()->sum('credited_amount');
    }

    public function extraFee()
    {
        if ($this->invoice->fee_is_percent === 1) {
            return formatDecimal(($this->invoice->extra_fee / 100) * $this->invoice->subTotal());
        }

        return formatDecimal($this->invoice->extra_fee);
    }

    public function totalTax()
    {
        return formatDecimal($this->invoice->tax1Amount() + $this->invoice->tax2Amount());
    }

    public function tax1Amount()
    {
        return formatDecimal(($this->invoice->tax / 100) * $this->invoice->subTotal());
    }

    public function tax2Amount()
    {
        return formatDecimal(($this->invoice->tax2 / 100) * $this->invoice->subTotal());
    }

    public function lateFee()
    {
        if ($this->invoice->isOverdue() && settingEnabled('final_reminder_late_fee') && now()->diffInDays($this->invoice->due_date) >= get_option('invoices_overdue_reminder3')) {
            if ($this->invoice->late_fee_percent === 1) {
                return formatDecimal(($this->invoice->late_fee / 100) * $this->invoice->subTotal());
            }
            return formatDecimal($this->invoice->late_fee);
        }
        return 0.00;
    }

    public function discounted()
    {
        if ($this->invoice->discount_percent === 1) {
            return formatDecimal(($this->invoice->discount / 100) * $this->invoice->subTotal());
        }

        return formatDecimal($this->invoice->discount);
    }

    public function due()
    {
        $bal = (($this->invoice->subTotal() - $this->invoice->discounted()) + $this->invoice->totalTax() + $this->invoice->extraFee() + $this->invoice->lateFee()) - $this->invoice->paid();
        return $bal <= 0 ? 0 : formatDecimal($bal - $this->invoice->creditedAmount());
    }

    public function paid()
    {
        $amount = 0;
        foreach ($this->invoice->payments()->active()->get() as $key => $paid) {
            if ($paid->currency != $this->invoice->currency) {
                $amount += convertCurrency($paid->currency, $paid->amount, $this->invoice->currency, $this->invoice->exchange_rate);
            } else {
                $amount += $paid->amount;
            }
        }

        return formatDecimal($amount);
    }

    public function payable()
    {
        return formatDecimal(($this->invoice->subTotal() + $this->invoice->totalTax() + $this->invoice->extraFee()) - $this->invoice->discounted());
    }
}
