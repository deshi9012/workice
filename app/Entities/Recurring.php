<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Invoices\Entities\Invoice;

class Recurring extends Model
{
    protected $fillable = [
        'recurrable_type', 'recurrable_id', 'frequency', 'recur_starts',
        'recur_ends', 'next_recur_date', 'notified_at',
    ];
    // protected $table = 'recurrings';
    protected $dates = ['recur_starts', 'recur_ends', 'next_recur_date'];

    public function recurrable()
    {
        return $this->morphTo();
    }

    public function recurrings()
    {
        $isActive = $this->whereDate('recur_ends', '>', now()->toDateTimeString())
            ->whereDate('recur_starts', '<=', now()->toDateTimeString())
            ->orWhere('recur_ends', '0000-00-00')
            ->get();

        $filtered = $isActive->filter(
            function ($value, $key) {
                return strtotime($value->next_recur_date) <= time();
            }
        );

        return $filtered->all();
    }

    // public function soonRecurring()
    // {
    //     $recur = array();
    //     $recurring = self::whereNull('notified_at')->get();

    //     foreach ($recurring as $key => &$rec) {
    //         if ($rec->invoice->due() <= 0 || $rec->invoice->status == 'cancelled' || $rec->status != 'active') {
    //             unset($recurring[$key]);
    //             continue;
    //         }
    //         $dt = Carbon::parse($rec->next_invoice_date);
    //         $today = Carbon::today();
    //         $diffDays = $dt->diffInDays($today, false);
    //         if ($diffDays != -1 * get_option('remind_recurring_days')) {
    //             unset($recurring[$key]);
    //             continue;
    //         }
    //     }

    //     return $recurring;
    // }

    // public function invoice()
    // {
    //     return $this->belongsTo(\Invoice::class, 'invoice_id');
    // }

    /**
     * Sets filter to only recurring invoices which should be generated now.
     *
     * @return \Mdl_Invoices_Recurring
     */
    // public function active()
    // {
    //     $isActive = self::whereDate('end_date', '>', today()->toDateString())
    //         ->orWhere('end_date', '0000-00-00')
    //         ->whereDate('start_date', '<=', today()->toDateString())
    //         ->get();

    //     $filtered = $isActive->filter(function ($value, $key) {
    //         return strtotime($value->next_invoice_date) <= time();
    //     });

    //     return $filtered->all();

    //     // return Capsule::select("SELECT * FROM $dbPrefix.invoices_recurring WHERE next_invoice_date <= date(NOW()) AND (end_date > date(NOW()) OR end_date = '0000-00-00') AND start_date <= date(NOW())");
    // }

    public function getDueDate()
    {
        return incrementDate($this->next_recur_date, get_option('invoices_due_after'));
    }

    public function setRecurStartsAttribute($value)
    {
        $this->attributes['recur_starts'] = dbDate($value);
    }

    public function setRecurEndsAttribute($value)
    {
        $this->attributes['recur_ends'] = dbDate($value);
    }

    public function setNextRecurDate()
    {
        $nextDate = nextRecurringDate($this->next_recur_date, $this->frequency);
        $this->update(['next_recur_date' => $nextDate]);
    }
}
