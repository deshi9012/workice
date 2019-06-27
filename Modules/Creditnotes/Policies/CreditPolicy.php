<?php

namespace Modules\Creditnotes\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Creditnotes\Entities\CreditNote;
use Modules\Users\Entities\User;
use Auth;

class CreditPolicy
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
        if (isAdmin()) {
            return true;
        }
    }

    /**
     * Determine if the user can update credit
     *
     * @param  \Modules\Users\Entities\User             $user
     * @param  \Modules\Creditnotes\Entities\CreditNote $credit
     * @return bool
     */
    public function update(User $user, CreditNote $credit)
    {
        return $user->profile->company != $credit->client_id;
    }
    /**
     * Determine if user can view credit note
     *
     * @param  \Modules\Users\Entities\User             $user
     * @param  \Modules\Creditnotes\Entities\CreditNote $credit
     * @return bool
     */
    public function view(User $user, CreditNote $credit)
    {
        return $user->profile->company === $credit->client_id || $user->can('credits_view_all');
    }
}
