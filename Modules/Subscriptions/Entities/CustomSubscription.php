<?php

namespace Modules\Subscriptions\Entities;

use Laravel\Cashier\Subscription;

class CustomSubscription extends Subscription
{
    protected $dates = [
        'trial_ends_at', 'ends_at',
        'created_at', 'updated_at',
    ];

    protected $table = 'subscriptions';
}
