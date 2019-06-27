<?php

namespace Modules\Estimates\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Estimates\Entities\Estimate;
use Modules\Users\Entities\User;

class EstimatePolicy
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
     * Determine if the given user can accept estimate
     *
     * @param  \Modules\Users\Entities\User         $user
     * @param  \Modules\Estimates\Entities\Estimate $estimate
     * @return bool
     */
    public function accept(User $user, Estimate $estimate)
    {
        return $user->profile->company === $estimate->client_id;
    }
    /**
     * Determine if the user can update estimate
     *
     * @param \Modules\Users\Entities\User         $user
     * @param \Modules\Estimates\Entities\Estimate $estimate
     */
    public function update(User $user, Estimate $estimate)
    {
        return $user->profile->company != $estimate->client_id;
    }
    /**
     * Determine if the user can view estimate
     *
     * @param \Modules\Users\Entities\User         $user
     * @param \Modules\Estimates\Entities\Estimate $estimate
     */
    public function view(User $user, Estimate $estimate)
    {
        return $user->profile->company === $estimate->client_id || $user->can('estimates_view_all');
    }

    /**
     * Determine if the given task can be updated by the user.
     *
     * @param  \Modules\Users\Entities\User         $user
     * @param  \Modules\Estimates\Entities\Estimate $estimate
     * @return bool
     */
    public function decline(User $user, Estimate $estimate)
    {
        return $user->profile->company === $estimate->client_id;
    }
}
