<?php

namespace Modules\Timetracking\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Users\Entities\User;

class TimerPolicy
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
     * Determine if user can update timer
     *
     * @param  \Modules\Users\Entities\User             $user
     * @param  \Modules\Timetracking\Entities\TimeEntry $entry
     * @return bool
     */
    public function update(User $user, TimeEntry $entry)
    {
        return $entry->user_id == \Auth::id();
    }
}
