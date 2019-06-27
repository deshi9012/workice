<?php

namespace Modules\Estimates\Entities;

use App\Traits\Actionable;
use App\Traits\Commentable;
use App\Traits\Customizable;
use App\Traits\Eventable;
use App\Traits\Itemable;
use App\Traits\Observable;
use App\Traits\Remindable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Deals\Entities\Deal;
use Modules\Estimates\Events\EstimateCreated;
use Modules\Estimates\Events\EstimateDeleted;
use Modules\Estimates\Events\EstimateUpdated;
use Modules\Estimates\Jobs\ComputeEstimate;
use Modules\Estimates\Notifications\EstimateCommented;
use Modules\Estimates\Observers\EstimateObserver;
use Modules\Estimates\Scopes\EstimateScope;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use Modules\Users\Entities\User;

class Estimate extends Model
{
    use SoftDeletes, Itemable, Actionable, Commentable, Taggable, Observable, Eventable, Remindable, Searchable,
    Uploadable, Customizable;

    protected static $observer = EstimateObserver::class;
    protected static $scope    = EstimateScope::class;

    protected $fillable = [
        'reference_no', 'title', 'client_id', 'deal_id', 'due_date', 'currency', 'discount', 'notes', 'tax', 'tax2',
        'status', 'sent_at', 'viewed_at', 'discount_percent', 'invoiced_id', 'invoiced_at', 'accepted_time',
        'rejected_time', 'rejected_reason', 'exchange_rate', 'is_visible', 'amount', 'sub_total',
        'discounted', 'tax1_amount', 'tax2_amount', 'archived_at', 'reminded_at', 'created_at',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => EstimateCreated::class,
        'updated' => EstimateUpdated::class,
        'deleted' => EstimateDeleted::class,
    ];

    protected $dates = [
        'due_date', 'deleted_at',
    ];

    public function company()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function subTotal()
    {
        return formatDecimal($this->items()->sum('total_cost'));
    }

    public function metaValue($key)
    {
        return optional($this->custom()->whereMetaKey($key)->first())->meta_value;
    }
    public function totalTax()
    {
        return $this->tax1Amount() + $this->tax2Amount();
    }

    public function tax1Amount()
    {
        return ($this->tax / 100) * $this->subTotal();
    }

    public function tax2Amount()
    {
        return ($this->tax2 / 100) * $this->subTotal();
    }

    public function discounted()
    {
        if ($this->discount_percent) {
            return formatDecimal(($this->discount / 100) * $this->subTotal());
        }

        return formatDecimal($this->discount);
    }

    public function isLocked()
    {
        return $this->status != 'Pending' ? true : false;
    }

    public function amount()
    {
        return ($this->subTotal() - $this->discounted()) + $this->totalTax();
    }

    public function commentAlert($comment)
    {
        $user = User::role('admin')->first();
        if ($user->id != $comment->user_id) {
            \Notification::send($user, new EstimateCommented($this));
        }
    }

    public function startComputeJob()
    {
        return ComputeEstimate::dispatch($this)->onQueue('high');
    }

    public function compute()
    {
        $this->update(
            [
                'amount'      => $this->amount(),
                'sub_total'   => $this->subTotal(),
                'discounted'  => $this->discounted(),
                'tax1_amount' => $this->tax1Amount(),
                'tax2_amount' => $this->tax2Amount(),
            ]
        );
    }

    public function ajaxTotals()
    {
        return [
            'total'    => formatCurrency($this->currency, $this->amount()),
            'subtotal' => formatCurrency($this->currency, $this->subTotal()),
            'tax1'     => formatCurrency($this->currency, $this->tax1Amount()),
            'tax2'     => formatCurrency($this->currency, $this->tax2Amount()),
            'discount' => formatCurrency($this->currency, $this->discounted()),
            'scope'    => 'estimates',
        ];
    }

    public function isEditable()
    {
        if ($this->status != 'Pending') {
            return false;
        }
        return true;
    }

    public function viewed()
    {
        if (!\Auth::check()) {
            if (is_null($this->viewed_at)) {
                event(new \Modules\Estimates\Events\EstimateViewed($this));
            }
        }
    }

    public function clientViewed()
    {
        if (\Auth::check() && !isAdmin()) {
            if (\Auth::user()->profile->company == $this->client_id) {
                if (is_null($this->viewed_at)) {
                    event(new \Modules\Estimates\Events\EstimateViewed($this));
                }
            }
        }
    }

    public function isDraft()
    {
        if ($this->status === 'Pending' && $this->is_sent === 0 && $this->is_visible === 0) {
            return true;
        }
        return false;
    }

    public function pdf($download = true)
    {
        return (new \App\Helpers\PDFEngine('estimates', $this, $download))->pdf();
    }

    public function newDeal()
    {
        $deal                 = new \Modules\Deals\Entities\Deal;
        $deal->title          = $this->title;
        $deal->stage_id       = get_option('default_deal_stage');
        $deal->deal_value     = $this->getOriginal('amount');
        $deal->contact_person = $this->company->primary_contact;
        $deal->organization   = $this->client_id;
        $deal->due_date       = $this->due_date;
        $deal->source         = \App\Entities\Category::deals()->first()->name;
        $deal->pipeline       = get_option('default_deal_pipeline');
        $deal->currency       = $this->currency;
        $deal->user_id        = \Auth::id();
        $deal->save();
        $this->update(['deal_id' => $deal->id]);
    }

    public function toProject()
    {
        $admin                   = \Modules\Users\Entities\User::role('admin')->first();
        $project                 = new Project;
        $project->code           = generateCode('projects');
        $project->name           = 'Project ' . $this->name;
        $project->description    = $this->notes;
        $project->client_id      = $this->client_id;
        $project->currency       = $this->currency;
        $project->start_date     = now()->toDateTimeString();
        $project->due_date       = now()->addDays(30);
        $project->billing_method = 'fixed_rate';
        $project->hourly_rate    = get_option('hourly_rate');
        $project->fixed_price    = formatDecimal($this->amount);
        $project->progress       = 0;
        $project->manager        = $admin->id;
        $project->auto_progress  = 1;
        $project->notes          = 'Created from Estimate ' . $this->name;
        $project->save();

        $project->assignees()->create(['user_id' => $admin->id]);
        // Default project settings
        $default_settings = json_decode(get_option('default_project_settings'), true);
        foreach ($default_settings as $key => &$value) {
            if (strtolower($value) == 'off') {
                unset($default_settings[$key]);
            }
        }
        $project->update(['settings' => $default_settings]);

        foreach ($this->items as $key => $item) {
            $task                  = new Task();
            $task->name            = $item->name;
            $task->project_id      = $project->id;
            $task->description     = $item->description;
            $task->start_date      = now()->toDateTimeString();
            $task->due_date        = now()->addDays(30);
            $task->estimated_hours = 0.00;
            $task->user_id         = \Auth::id();
            $task->save();
            $task->assignees()->create(['user_id' => $admin->id]);
        }

        return $project;
    }

    public function toInvoice()
    {
        $filtered = array_only(
            $this->toArray(),
            [
                'client_id', 'due_date', 'currency', 'discount', 'notes', 'tax', 'tax2', 'is_visible', 'discount_percent',
            ]
        );
        $filtered['reference_no'] = generateCode('invoices');
        $invoice                  = \Modules\Invoices\Entities\Invoice::create($filtered);
        foreach ($this->items as $key => $item) {
            $invoice->items()->create(array_except($item->toArray(), ['id']));
        }
        $this->update(
            [
                'invoiced_id' => $invoice->id, 'invoiced_at' => now()->toDateTimeString(),
            ]
        );
        $invoice->retag($this->tagList);
        event(new \Modules\Estimates\Events\EstimateInvoiced($this, \Auth::check() ? \Auth::id() : 1));
        return $invoice;
    }

    public function getStatusAttribute()
    {
        if ($this->getOriginal('status') === 'Accepted') {
            return langapp('accepted');
        }
        if (!is_null($this->viewed_at)) {
            return langapp('viewed');
        }
        if (!is_null($this->sent_at)) {
            return langapp('sent');
        }
        if ($this->isOverdue()) {
            return langapp('overdue');
        }
        return langapp(strtolower($this->getOriginal('status')));
    }

    public function statusIcon()
    {
        if ($this->getOriginal('status') === 'Accepted') {
            return '<span class="text-success">✔</span> ';
        }
        if ($this->isOverdue() || $this->getOriginal('status') === 'Declined') {
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

    public function nextCode()
    {
        $code = get_option('estimate_prefix') . sprintf('%04d', get_option('estimate_start_no'));
        $max  = $this->withoutGlobalScopes()->whereNotNull('reference_no')->max('id');
        if ($max > 0) {
            $row         = $this->withoutGlobalScopes()->find($max);
            $ref_number  = intval(substr($row->reference_no, -4));
            $next_number = $ref_number + 1;
            if ($next_number < get_option('estimate_start_no')) {
                $next_number = get_option('estimate_start_no');
            }
            $next_number = $this->codeExists($next_number);

            $code = $this->formattedCode($next_number);
        }
        return $code;
    }
    public function codeExists($next_number)
    {
        $next_number = sprintf('%04d', $next_number);
        if ($this->withoutGlobalScopes()->withTrashed()->whereReferenceNo($this->formattedCode($next_number))->count() > 0) {
            return $this->codeExists((int) $next_number + 1);
        }
        return $next_number;
    }

    private function formattedCode($num)
    {
        if (!empty(get_option('estimate_number_format'))) {
            return get_option('estimate_prefix') . referenceFormatted(get_option('estimate_number_format'), $num);
        } else {
            return get_option('estimate_prefix') . sprintf('%04d', $num);
        }
    }

    public function isOverdue()
    {
        return strtotime($this->due_date) < time() && $this->amount > 0;
    }

    public function setStatusAttribute($value)
    {
        $enum                       = ['Accepted', 'Declined', 'Pending'];
        $this->attributes['status'] = in_array($value, $enum) ? $value : 'Pending';
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = dbDate($value);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'Pending')->whereNull('archived_at');
    }

    public function scopeAccepted($query)
    {
        return $query->whereNotNull('accepted_time')->whereNull('archived_at');
    }
    public function scopeRejected($query)
    {
        return $query->whereNotNull('rejected_time')->whereNull('archived_at');
    }

    public function scopeReminderAlerts($query)
    {
        return $query->where('status', 'Pending')->whereDate('due_date', '>=', now())->whereDate('due_date', '<=', now()->addDays(get_option('remind_estimates_before')))->whereNull('reminded_at');
    }

    public function getNameAttribute()
    {
        return is_null($this->title) ? '#' . $this->reference_no : $this->title;
    }
    public function getUrlAttribute()
    {
        return '/estimates/view/' . $this->id;
    }
}
