<?php

namespace Modules\Payments\Entities;

use App\Entities\AcceptPayment;
use App\Traits\Actionable;
use App\Traits\Commentable;
use App\Traits\Eventable;
use App\Traits\Observable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Observers\PaymentObserver;
use Modules\Payments\Scopes\PaymentScope;
use Modules\Projects\Entities\Project;

class Payment extends Model
{
    use SoftDeletes, Actionable, Commentable, Taggable, Observable, Uploadable, Eventable, Searchable;

    protected static $observer = PaymentObserver::class;
    protected static $scope    = PaymentScope::class;

    protected $fillable = [
        'invoice_id',
        'client_id',
        'payer_email',
        'payment_method',
        'currency',
        'amount',
        'code',
        'notes',
        'partial_id',
        'payment_date',
        'is_refunded',
        'meta',
        'exchange_rate',
        'project_id',
        'send_email',
        'archived_at',
        'amount_formatted',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    protected $dates = [
        'payment_date',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => \Modules\Payments\Events\PaymentReceived::class,
        'updated' => \Modules\Payments\Events\PaymentUpdated::class,
        'deleted' => \Modules\Payments\Events\PaymentDeleted::class,
    ];

    public function AsInvoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function company()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function commentAlert($comment)
    {
    }

    public function pdf($download = true)
    {
        return (new \App\Helpers\PDFEngine('payments', $this, $download))->pdf();
    }

    public function statusIcon()
    {
        if ($this->is_refunded === 0) {
            return '<span class="text-success">✔</span> ';
        }
        if ($this->is_refunded === 1) {
            return '<span class="text-danger">✘</span> ';
        }

        return '<i class="fas fa-exclamation-circle text-warning"></i> ';
    }

    public function nextCode()
    {
        $code = get_option('payment_prefix') . sprintf('%04d', 1);
        $max  = $this->withoutGlobalScopes()->whereNotNull('code')->max('id');
        if ($max > 0) {
            $row         = $this->withoutGlobalScopes()->find($max);
            $ref_number  = intval(substr($row->code, -4));
            $next_number = $ref_number + 1;
            $next_number = $this->codeExists($next_number);

            $code = $this->formattedCode($next_number);
        }
        return $code;
    }

    public function compute()
    {
    }

    protected function codeExists($next_number)
    {
        $next_number = sprintf('%04d', $next_number);
        if ($this->withTrashed()->whereCode($this->formattedCode($next_number))->count() > 0) {
            return $this->codeExists((int) $next_number + 1);
        }
        return $next_number;
    }

    protected function formattedCode($num)
    {
        if (!empty(get_option('payment_number_format'))) {
            return get_option('payment_prefix') . referenceFormatted(get_option('payment_number_format'), $num);
        } else {
            return get_option('payment_prefix') . sprintf('%04d', $num);
        }
    }

    public function paymentMethod()
    {
        return $this->belongsTo(AcceptPayment::class, 'payment_method', 'method_id');
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = dbDate($value);
    }

    public function setAmountFormattedAttribute($value)
    {
        $this->attributes['amount_formatted'] = formatCurrency($this->currency, $this->amount);
    }

    public function scopeActive($query)
    {
        return $query->whereIsRefunded(0);
    }
    public function getUrlAttribute()
    {
        return '/payments/view/' . $this->id;
    }
}
