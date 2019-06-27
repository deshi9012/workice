<?php

namespace Modules\Invoices\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Invoices\Entities\Invoice;
use Modules\Users\Entities\User;
use Auth;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before()
    {
        if (isAdmin() || Auth::user()->can('invoices_view_all')) {
            return true;
        }
    }

    /**
     * Determine if the user can view invoice
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Invoices\Entities\Invoice $invoice
     * @return bool
     */
    public function view(User $user, Invoice $invoice)
    {
        return $user->profile->company === $invoice->client_id;
    }
}
