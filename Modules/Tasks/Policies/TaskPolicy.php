<?php

namespace Modules\Tasks\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Tasks\Entities\Task;
use Modules\Users\Entities\User;

class TaskPolicy
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
     * Determine if the user can update task
     *
     * @param  \Modules\Users\Entities\User $user
     * @param  \Modules\Tasks\Entities\Task $task
     * @return bool
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id || $task->isTeam();
    }

    /**
     * Determine if the user can delete task
     *
     * @param  \Modules\Users\Entities\User $user
     * @param  \Modules\Tasks\Entities\Task $task
     * @return bool
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
