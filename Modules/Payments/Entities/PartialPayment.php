<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Entities\Payment;

class PartialPayment extends Model
{
    protected $fillable = ['invoice_id', 'percentage', 'due_date', 'notes', 'is_paid'];

    public function balance()
    {
        $paidPartial = Payment::select('amount')->wherePartialId($this->id)->active()->sum('amount');

        return round(($this->invoice->payable * ($this->percentage / 100)) - $paidPartial, 2);
    }

    public function payable()
    {
        return round(($this->invoice->payable * ($this->percentage / 100)), 2);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = dbDate($value);
    }
}
