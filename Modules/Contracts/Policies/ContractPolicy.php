<?php

namespace Modules\Contracts\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Contracts\Entities\Contract;
use Modules\Users\Entities\User;

class ContractPolicy
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

    public function view(User $user, Contract $contract)
    {
        return $user->profile->company === $contract->client_id || $user->can('contracts_view_all');
    }

    public function update(User $user, Contract $contract)
    {
        return $contract->user_id == \Auth::id();
    }
    public function delete(User $user, Contract $contract)
    {
        return $contract->user_id == \Auth::id();
    }
}
