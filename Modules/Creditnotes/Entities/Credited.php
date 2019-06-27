<?php

namespace Modules\Creditnotes\Entities;

use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Modules\Creditnotes\Entities\CreditNote;
use Modules\Creditnotes\Observers\CreditedObserver;
use Modules\Invoices\Entities\Invoice;

class Credited extends Model
{
    use Observable;
    
    protected $fillable = [
        'creditnote_id','invoice_id','credited_amount'
    ];
    protected $table = 'invoices_credited';

    protected static $observer = CreditedObserver::class;
    protected static $scope    = null;

    public function credit()
    {
        return $this->belongsTo(CreditNote::class, 'creditnote_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
