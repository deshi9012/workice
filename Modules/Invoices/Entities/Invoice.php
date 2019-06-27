<?php

namespace Modules\Invoices\Entities;

use App\Traits\Actionable;
use App\Traits\Commentable;
use App\Traits\Customizable;
use App\Traits\Eventable;
use App\Traits\Itemable;
use App\Traits\Observable;
use App\Traits\Recurrable;
use App\Traits\Remindable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Uploadable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Clients\Jobs\ClientBalance;
use Modules\Creditnotes\Entities\Credited;
use Modules\Invoices\Emails\InvoiceMail;
use Modules\Invoices\Events\InvoiceCreated;
use Modules\Invoices\Events\InvoiceDeleted;
use Modules\Invoices\Events\InvoicePaid;
use Modules\Invoices\Events\InvoiceSent;
use Modules\Invoices\Jobs\ApplyCredits;
use Modules\Invoices\Jobs\CalculateInvoice;
use Modules\Invoices\Notifications\InvoiceCommented;
use Modules\Invoices\Observers\InvoiceObserver;
use Modules\Invoices\Scopes\InvoiceScope;
use Modules\Invoices\Services\InvoiceCalculator;
use Modules\Payments\Entities\PartialPayment;
use Modules\Payments\Entities\Payment;
use Modules\Projects\Entities\Project;
use Modules\Users\Entities\User;

class Invoice extends Model
{
    use SoftDeletes, Commentable, Taggable, Actionable, Itemable, Observable, Searchable,
    Eventable, Remindable, Uploadable, Recurrable, Customizable;

    protected static $observer = InvoiceObserver::class;
    protected static $scope    = InvoiceScope::class;

    protected $fillable = [
        'reference_no', 'title', 'client_id', 'due_date', 'notes', 'tax', 'tax2', 'discount', 'currency',
        'alert_overdue', 'extra_fee', 'fee_is_percent', 'exchange_rate', 'reminded_at', 'status', 'payable',
        'balance', 'tax_total', 'discount_percent', 'paid_amount', 'project_id',
        'is_locked', 'late_fee', 'late_fee_percent', 'gateways', 'is_recurring', 'is_visible', 'recurred_from',
        'viewed_at', 'reminder1', 'reminder2', 'reminder3', 'sent_at', 'cancelled_at', 'archived_at', 'created_at',
    ];
    protected $casts = [
        'gateways'        => 'array',
        'payment_options' => 'array',
        'is_recurring'    => 'integer',
    ];

    protected $dates = [
        'due_date', 'cancelled_at',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => InvoiceCreated::class,
        'deleted' => InvoiceDeleted::class,
    ];

    /**
     * Get invoice credited records.
     */
    public function credited()
    {
        return $this->hasMany(Credited::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get invoice payments.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('id', 'desc');
    }

    /**
     * Get invoice installments.
     */
    public function installments()
    {
        return $this->hasMany(PartialPayment::class, 'invoice_id');
    }

    public function company()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function hasPayment()
    {
        return $this->payments()->count() > 0 ? true : false;
    }

    public function children()
    {
        return $this->hasMany(Invoice::class, 'recurred_from');
    }

    public function isClient()
    {
        return \Auth::user()->profile->company == $this->client_id ? true : false;
    }

    public function metaValue($key)
    {
        return optional($this->custom()->whereMetaKey($key)->first())->meta_value;
    }

    // public function amountToPay($type)
    // {
    //     switch ($data['payment']) {
    //     case 'minimum':
    //         $amount = formatDecimal($this->nextUnpaidPartial());
    //         break;
    //     case 'full':
    //         $amount = formatDecimal($this->due());
    //         break;

    //     default:
    //         $amount = $data['amount'];
    //         break;
    //     }

    //     return $amount;
    // }

    public function commentAlert($comment)
    {
        $user = User::role('admin')->first();
        if ($user->id != $comment->user_id) {
            \Notification::send($user, new InvoiceCommented($this));
        }
    }

    // Check if invoice overpaid
    public function overpaid($amount = 0)
    {
        if ($amount > $this->due()) {
            return true;
        }

        return false;
    }

    // Get next installment
    public function nextUnpaidPartial($show_balance = true)
    {
        $balance = 0;
        $p       = [];
        foreach ($this->installments as $key => $partial) {
            $p = PartialPayment::findOrFail($partial->id);
            if ($p->balance() > 0) {
                $balance = $p->balance();
                break;
            }
        }
        if ($show_balance) {
            return ($balance <= 0) ? $this->due() : $balance;
        }

        return $p;
    }

    public function updateStatus()
    {
        if (!is_null($this->cancelled_at)) {
            return $this->update(['status' => 'cancelled']);
        }
        if ($this->isOverdue()) {
            return $this->update(['status' => 'overdue']);
        }
        if ($this->payable > 0 && $this->balance <= 0) {
            event(new InvoicePaid($this));
            return $this->update(['status' => 'fully_paid', 'is_locked' => 1]);
        }
        if ($this->due() > 0 && $this->paid() > 0) {
            return $this->update(['status' => 'partially_paid', 'is_locked' => 0]);
        }
        if (!is_null($this->viewed_at)) {
            return $this->update(['status' => 'viewed']);
        }
        if (!is_null($this->sent_at)) {
            return $this->update(['status' => 'sent']);
        }
        if ($this->paid_amount <= 0) {
            return $this->update(['status' => 'not_paid', 'is_locked' => 0]);
        }
    }
    public function isEditable()
    {
        if ($this->getOriginal('status') != 'fully_paid') {
            return true;
        }
        return false;
    }

    public function isPaid()
    {
        if ($this->balance <= 0 && $this->payable > 0) {
            return true;
        }
        return false;
    }

    public function isDraft()
    {
        if ($this->emailed === 'No' && $this->paid() <= 0 && $this->show_client === 'No') {
            return true;
        }
        return false;
    }

    public function statusIcon()
    {
        if ($this->isPaid()) {
            return '<span class="text-success">✔</span> ';
        }
        if ($this->isOverdue()) {
            return '<span class="text-danger">✘</span> ';
        }
        if (!is_null($this->sent_at)) {
            return '<i class="fas fa-envelope-open text-info"></i> ';
        }
        if ($this->is_visible == 0) {
            return '<i class="far fa-file-alt text-warning"></i>';
        }

        return '<i class="fas fa-exclamation-circle text-warning"></i> ';
    }

    public function recur()
    {
        $recurDays = request('recurring.frequency');
        $nextDate  = nextRecurringDate(today(), $recurDays);
        $this->update(['is_recurring' => 1]);
        return $this->recurring()->updateOrCreate(
            ['recurrable_id' => $this->id],
            [
                'next_recur_date' => $nextDate,
                'recur_starts'    => dbDate(request('recurring.recur_starts')),
                'recur_ends'      => dbDate(request('recurring.recur_ends')),
                'frequency'       => $recurDays,
            ]
        );
    }

    public function recurred()
    {
        $this->update(
            [
                'reference_no' => 'R-' . $this->reference_no,
                'is_recurring' => 0,
                'due_date'     => now()->addDays(get_option('invoices_due_after', '15'))->toDateTimeString(),
                'sent_at'      => null,
                'viewed_at'    => null,
                'reminder1'    => null,
                'reminder2'    => null,
                'reminder3'    => null,
                'cancelled_at' => null,
            ]
        );
        if (settingEnabled('apply_credits')) {
            ApplyCredits::dispatch($this)->delay(now()->addMinutes(2));
        }
        if (settingEnabled('automatic_email_on_recur')) {
            \Mail::to($this->company)->send(new InvoiceMail($this));
            event(new InvoiceSent($this, User::role('admin')->first()->id));
        }
    }

    public function isOverdue()
    {
        return strtotime($this->due_date) < time() && $this->balance > 0;
    }

    public function payable()
    {
        return (new InvoiceCalculator($this))->payable();
    }

    public function due()
    {
        return (new InvoiceCalculator($this))->due();
    }

    public function discounted()
    {
        return (new InvoiceCalculator($this))->discounted();
    }

    public function lateFee()
    {
        return (new InvoiceCalculator($this))->lateFee();
    }

    public function tax1Amount()
    {
        return (new InvoiceCalculator($this))->tax1Amount();
    }

    public function tax2Amount()
    {
        return (new InvoiceCalculator($this))->tax2Amount();
    }

    public function totalTax()
    {
        return (new InvoiceCalculator($this))->totalTax();
    }

    public function extraFee()
    {
        return (new InvoiceCalculator($this))->extraFee();
    }

    public function subTotal()
    {
        return (new InvoiceCalculator($this))->subTotal();
    }

    public function creditedAmount()
    {
        return (new InvoiceCalculator($this))->creditedAmount();
    }

    public function paid()
    {
        return (new InvoiceCalculator($this))->paid();
    }

    public function startComputeJob()
    {
        return CalculateInvoice::dispatch($this);
    }

    public function clientViewed()
    {
        if (\Auth::check() && !isAdmin()) {
            if (\Auth::user()->profile->company == $this->client_id) {
                if (is_null($this->viewed_at)) {
                    event(new \Modules\Invoices\Events\InvoiceViewed($this));
                }
            }
        }
    }

    public function compute()
    {
        $this->update(
            [
                'payable'     => $this->payable(),
                'balance'     => $this->due(),
                'tax_total'   => $this->totalTax(),
                'paid_amount' => $this->paid(),
            ]
        );
        !is_null($this->company) ? ClientBalance::dispatch($this->company)->onQueue('high') : '';
        $this->updateStatus();
    }

    public function ajaxTotals()
    {
        return [
            'due'      => formatCurrency($this->currency, $this->due()),
            'subtotal' => formatCurrency($this->currency, $this->subTotal()),
            'tax1'     => formatCurrency($this->currency, $this->tax1Amount()),
            'tax2'     => formatCurrency($this->currency, $this->tax2Amount()),
            'discount' => formatCurrency($this->currency, $this->discounted()),
            'fee'      => formatCurrency($this->currency, $this->extraFee()),
            'paid'     => formatCurrency($this->currency, $this->paid()),
            'credits'  => formatCurrency($this->currency, $this->creditedAmount()),
            'scope'    => 'invoices',
        ];
    }

    public function pdf($download = true)
    {
        return (new \App\Helpers\PDFEngine('invoices', $this, $download))->pdf();
    }

    public function nextCode()
    {
        $code = $this->formattedCode(sprintf('%04d', get_option('invoice_start_no'))); // get_option('invoice_prefix') . ;
        $max  = $this->withoutGlobalScopes()->whereNotNull('reference_no')->max('id');
        if ($max > 0) {
            $row         = $this->withoutGlobalScopes()->find($max);
            $ref_number  = intval(substr($row->reference_no, -4));
            $next_number = $ref_number + 1;
            if ($next_number < get_option('invoice_start_no')) {
                $next_number = get_option('invoice_start_no');
            }
            $next_number = $this->codeExists($next_number);

            $code = $this->formattedCode($next_number);
        }
        return $code;
    }
    protected function codeExists($nextNumber)
    {
        $nextNumber = sprintf('%04d', $nextNumber);
        if ($this->withoutGlobalScopes()->withTrashed()->where('reference_no', $this->formattedCode($nextNumber))->count() > 0) {
            return $this->codeExists((int) $nextNumber + 1);
        }
        return $nextNumber;
    }

    protected function formattedCode($num)
    {
        if (!empty(get_option('invoice_number_format'))) {
            return get_option('invoice_prefix') . referenceFormatted(get_option('invoice_number_format'), $num);
        } else {
            return get_option('invoice_prefix') . sprintf('%04d', $num);
        }
    }

    public function dueDays()
    {
        return $this->created_at->diffInDays(Carbon::parse($this->due_date));
    }

    public function stopRecurring()
    {
        if ($this->is_recurring === 1) {
            $this->update(['is_recurring' => 0]);
            return $this->recurring->delete();
        }
    }

    public function gatewayEnabled($gateway)
    {
        return isset($this->gateways[$gateway]) && $this->gateways[$gateway] === 'active';
    }

    public function saveInstallments()
    {
        if (!$this->hasPayment()) {
            if (request()->has('partial-amount')) {
                $this->installments()->delete();
                foreach (request('partial-amount') as $key => $value) {
                    $this->installments()->create(
                        [
                            'percentage' => $value,
                            'due_date'   => request('partial-due_date.' . $key),
                            'notes'      => request('partial-notes.' . $key),
                        ]
                    );
                }
                return true;
            } else {
                if ($this->installments->count() == 0) {
                    $this->installments()->create(
                        [
                            'percentage' => 100,
                            'due_date'   => $this->due_date,
                            'notes'      => '',
                        ]
                    );
                }
            }
        }
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = dbDate($value);
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = dbDate($value);
    }

    public function setTaxAttribute($value)
    {
        $this->attributes['tax'] = is_null($value) ? 0.00 : $value;
    }

    public function setDiscountPercentAttribute($value)
    {
        $this->attributes['discount_percent'] = is_null($value) ? 1 : $value;
    }

    public function setCurrencyAttribute($value)
    {
        $this->attributes['currency'] = is_null($value) ? get_option('default_currency') : $value;
    }

    public function scopeOpen($query)
    {
        return $query->where('status', '!=', 'fully_paid')->whereNull('cancelled_at');
    }
    public function scopeReminderAlerts($query)
    {
        return $query->open()->whereDate('due_date', '>=', now())->whereDate('due_date', '<=', now()->addDays(get_option('remind_invoices_before')))->whereNull('reminded_at');
    }
    public function getNotesAttribute($value)
    {
        return str_replace('{BANKACCOUNT}', get_option('invoice_payment_info'), $value);
    }
    public function getStatusAttribute($value)
    {
        return langapp($this->getOriginal('status'), [], app()->getLocale());
    }
    public function getNameAttribute()
    {
        return empty($this->title) ? '#' . $this->reference_no : $this->title;
    }
    public function getUrlAttribute()
    {
        return '/invoices/view/' . $this->id;
    }
}
