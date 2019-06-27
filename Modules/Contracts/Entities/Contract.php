<?php

namespace Modules\Contracts\Entities;

use App\Traits\Actionable;
use App\Traits\BelongsToUser;
use App\Traits\Commentable;
use App\Traits\Observable;
use App\Traits\Remindable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Contracts\Entities\Signature;
use Modules\Contracts\Events\ContractCreated;
use Modules\Contracts\Events\ContractDeleted;
use Modules\Contracts\Observers\ContractObserver;
use Modules\Contracts\Scopes\ContractScope;
use Modules\Projects\Entities\Project;
use Modules\Users\Entities\User;

class Contract extends Model
{
    use SoftDeletes, Commentable, Actionable, Observable, Remindable, BelongsToUser, Searchable, Taggable, Uploadable;

    protected static $observer = ContractObserver::class;
    protected static $scope    = ContractScope::class;

    protected $fillable = [
        'client_id', 'contract_title', 'start_date', 'end_date', 'rate_is_fixed', 'fixed_rate', 'hourly_rate',
        'description', 'currency', 'license_owner', 'expiry_date', 'payment_terms', 'late_payment_fee', 'late_fee_percent',
        'termination_notice', 'cancelation_fee', 'signed', 'viewed_at', 'sent_at', 'is_visible', 'rejected_at', 'rejected_reason',
        'deposit_required', 'services', 'client_rights', 'portfolio_rights', 'non_compete', 'feedbacks', 'appropriate_conduct',
        'annotations', 'client_sign_id', 'contractor_sign_id', 'user_id', 'reminded_at',
    ];
    protected $cast = [
        'signed'      => 'integer',
        'hourly_rate' => 'float',
        'fixed_rate'  => 'float',
    ];
    protected $appends = ['status'];
    protected $dates   = [
        'start_date',
        'expiry_date',
        'end_date',
        'deleted_at',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ContractCreated::class,
        'deleted' => ContractDeleted::class,
    ];

    public function company()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function contractorSign()
    {
        return $this->belongsTo(Signature::class, 'contractor_sign_id');
    }
    public function clientSign()
    {
        return $this->belongsTo(Signature::class, 'client_sign_id');
    }

    public function clientViewed()
    {
        if (\Auth::check() && !isAdmin()) {
            if (is_null($this->viewed_at)) {
                event(new \Modules\Contracts\Events\ContractViewed($this));
            }
        }
    }

    public function isExpired()
    {
        return (strtotime($this->expiry_date) < time() && $this->signed === 0) ? true : false;
    }

    public function pdf($download = true)
    {
        return (new \App\Helpers\PDFEngine('contracts', $this, $download))->pdf();
    }

    public function createProjectFromContract()
    {
        $admin   = User::role('admin')->first();
        $project = Project::create(
            [
                'code'           => generateCode('projects'),
                'name'           => $this->contract_title,
                'description'    => $this->description,
                'client_id'      => $this->client_id,
                'currency'       => $this->currency,
                'start_date'     => $this->start_date,
                'due_date'       => $this->end_date,
                'billing_method' => ($this->rate_is_fixed == 1) ? 'fixed_rate' : 'hourly_project_rate',
                'hourly_rate'    => $this->hourly_rate,
                'fixed_price'    => $this->fixed_rate,
                'progress'       => 0,
                'notes'          => $this->services,
                'manager'        => $admin->id,
                'auto_progress'  => 1,
                'settings'       => json_decode(get_option('default_project_settings')),
                'contract_id'    => $this->id,
            ]
        );
        $project->assignees()->create(['user_id' => $admin->id]);
        return $project;
    }

    public function getStatusAttribute()
    {
        if ($this->signed === 1) {
            return langapp('signed');
        }
        if (!is_null($this->rejected_at)) {
            return langapp('declined');
        }
        if ($this->isExpired()) {
            return langapp('expired');
        }
        if (!is_null($this->sent_at)) {
            return langapp('sent');
        }
        if (!is_null($this->viewed_at)) {
            return langapp('viewed');
        }
        return langapp('pending');
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = dbDate($value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = dbDate($value);
    }

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = incrementDate($this->start_date, $value);
    }

    public function scopeViewed($query)
    {
        return $query->whereNotNull('viewed_at')->whereSigned(0);
    }
    public function scopeIsDraft($query)
    {
        return $query->where('is_visible', 1);
    }

    public function scopeDone($query)
    {
        return $query->whereSigned(1);
    }

    public function scopeReminderAlerts($query)
    {
        return $query->whereNull('client_sign_id')->whereDate('expiry_date', '>=', now())->whereDate('expiry_date', '<=', now()->addDays(config('system.remind_contracts_before')))->whereNull('reminded_at');
    }

    public function scopeSent($query)
    {
        return $query->whereNotNull('sent_at')->whereSigned(0);
    }
    public function scopeRejected($query)
    {
        return $query->whereNotNull('rejected_at')->whereSigned(0);
    }
    public function scopeExpired($query)
    {
        return $query->whereDate('expiry_date', '<', now())->where('signed', 0);
    }
    public function getUrlAttribute()
    {
        return '/contracts/view/' . $this->id;
    }
}
