<?php

namespace Modules\Creditnotes\Entities;

use App\Traits\Actionable;
use App\Traits\Commentable;
use App\Traits\Itemable;
use App\Traits\Observable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Creditnotes\Entities\Credited;
use Modules\Creditnotes\Events\CreditNoteCreated;
use Modules\Creditnotes\Events\CreditNoteDeleted;
use Modules\Creditnotes\Events\CreditNoteUpdated;
use Modules\Creditnotes\Jobs\CalculateCredits;
use Modules\Creditnotes\Observers\CreditNoteObserver;
use Modules\Creditnotes\Scopes\CreditNoteScope;

class CreditNote extends Model
{
    use SoftDeletes, Actionable, Commentable, Itemable, Taggable, Observable, Searchable, Uploadable;

    protected static $observer = CreditNoteObserver::class;
    protected static $scope    = CreditNoteScope::class;

    protected $fillable = [
        'reference_no', 'client_id', 'status', 'sent_at', 'currency', 'notes', 'terms', 'tax', 'exchange_rate', 'is_refunded',
        'archived_at', 'amount', 'balance',
    ];

    protected $dates = [
        'deleted_at', 'created_at',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CreditNoteCreated::class,
        'updated' => CreditNoteUpdated::class,
        'deleted' => CreditNoteDeleted::class,
    ];

    public function company()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function balance()
    {
        $crCredited = $this->credited()->sum('credited_amount');

        return formatDecimal($this->total() - $crCredited);
    }

    public function isEditable()
    {
        if ($this->status === 'open') {
            return true;
        }
        return false;
    }

    public function tax()
    {
        return formatDecimal(($this->tax / 100) * $this->subTotal());
    }

    public function credited()
    {
        return $this->hasMany(Credited::class, 'creditnote_id')->orderBy('id', 'desc');
    }

    public function subTotal()
    {
        return formatDecimal($this->items->sum('total_cost'));
    }

    public function usedCredits()
    {
        return $this->credited->sum('credited_amount');
    }

    public function total()
    {
        return formatDecimal($this->subTotal() + $this->tax());
    }

    public function statusIcon()
    {
        if ($this->status === 'closed') {
            return '<span class="text-success">✔</span> ';
        }
        if ($this->is_refunded === 1) {
            return '<span class="text-danger">✘</span> ';
        }
        if (!is_null($this->sent_at)) {
            return '<i class="fas fa-envelope-open text-info"></i> ';
        }

        return '<i class="fas fa-exclamation-circle text-warning"></i> ';
    }

    public function pdf($download = true)
    {
        return (new \App\Helpers\PDFEngine('creditnotes', $this, $download))->pdf();
    }

    public function nextCode()
    {
        $code = get_option('creditnote_prefix') . sprintf('%04d', get_option('creditnote_start_no'));
        $max  = $this->whereNotNull('reference_no')->max('id');
        if ($max > 0) {
            $row         = $this->find($max);
            $ref_number  = intval(substr($row->reference_no, -4));
            $next_number = $ref_number + 1;
            if ($next_number < get_option('creditnote_start_no')) {
                $next_number = get_option('creditnote_start_no');
            }
            $next_number = $this->codeExists($next_number);

            $code = $this->formattedCode($next_number);
        }
        return $code;
    }
    protected function codeExists($next_number)
    {
        $next_number = sprintf('%04d', $next_number);
        if ($this->withTrashed()->whereReferenceNo($this->formattedCode($next_number))->count() > 0) {
            return $this->codeExists((int) $next_number + 1);
        }
        return $next_number;
    }

    protected function formattedCode($num)
    {
        if (!empty(get_option('creditnote_number_format'))) {
            return get_option('creditnote_prefix') . referenceFormatted(get_option('creditnote_number_format'), $num);
        } else {
            return get_option('creditnote_prefix') . sprintf('%04d', $num);
        }
    }

    public function setTaxAttribute($value)
    {
        $this->attributes['tax'] = formatDecimal($value);
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = dbDate($value);
    }

    public function startComputeJob()
    {
        return CalculateCredits::dispatch($this)->onQueue('high');
    }

    public function compute()
    {
        return $this->update(
            [
                'amount'  => $this->total(),
                'balance' => $this->balance(),
            ]
        );
    }

    public function ajaxTotals()
    {
        return [
            'balance'  => formatCurrency($this->currency, $this->balance()),
            'subtotal' => formatCurrency($this->currency, $this->subTotal()),
            'used'     => formatCurrency($this->currency, $this->usedCredits()),
            'tax'      => formatCurrency($this->currency, $this->tax()),
            'scope'    => 'creditnotes',
        ];
    }

    public function scopeOpen($query)
    {
        return $query->whereStatus('open');
    }
    public function scopeClosed($query)
    {
        return $query->whereStatus('closed');
    }

    public function getUsedAttribute()
    {
        return $this->usedCredits();
    }

    public function getNameAttribute()
    {
        return $this->reference_no;
    }
    public function getUrlAttribute()
    {
        return '/creditnotes/view/' . $this->id;
    }
}
