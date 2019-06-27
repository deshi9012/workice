<?php

namespace App\Traits;

use Laravel\Cashier\Billable;
use Modules\Subscriptions\Entities\CustomSubscription;

trait CustomBillable
{
    use Billable {
        invoices as subInvoices;
    }

    /**
     * Override the subscriptions() from Larave\Cashier\Billable
     * to inject CustomSubscription model
     */
    public function subscriptions()
    {
        return $this->hasMany(CustomSubscription::class, $this->getForeignKey())->orderBy('created_at', 'desc');
    }
}
