<?php

namespace Modules\Subscriptions\Entities;

use App\Traits\BelongsToUser;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\Clients\Entities\Client;

class SubscriptionPlan extends Model
{
    use BelongsToUser, Searchable;
    
    protected $fillable = ['user_id', 'name', 'billing_date', 'client_id', 'stripe_plan_id', 'description'];
    protected $table = 'subscription_plans';
    protected $dates = ['billing_date', 'created_at', 'updated_at'];

    public function owner()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id();
    }

    public function setBillingDateAttribute($value)
    {
        $this->attributes['billing_date'] = dbDate($value);
    }
}
