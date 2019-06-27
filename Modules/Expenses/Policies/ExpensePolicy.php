<?php

namespace Modules\Expenses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Expenses\Entities\Expense;
use Modules\Users\Entities\User;
use Auth;

class ExpensePolicy
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
        if (isAdmin() || Auth::user()->can('expenses_view_all')) {
            return true;
        }
    }

    /**
     * Determine if the given task can be updated by the user.
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Expenses\Entities\Expense $expense
     * @return bool
     */
    public function view(User $user, Expense $expense)
    {
        return $user->profile->company === $expense->client_id;
    }
}
