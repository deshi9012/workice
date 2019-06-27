<?php

namespace Modules\Projects\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Projects\Entities\Project;
use Modules\Users\Entities\User;

class ProjectPolicy
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
     * Determine if the user can create task
     *
     * @param  \Modules\Users\Entities\User $user
     * @param  \Modules\Tasks\Entities\Task $task
     * @return bool
     */
    public function createTask(User $user, Project $project)
    {
        return can('tasks_create') || $project->isTeam() || $project->setting('client_add_tasks');
    }

    /**
     * Determine if a user can mark project as done
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Projects\Entities\Project $project
     * @return bool
     */
    public function done(User $user, Project $project)
    {
        return $project->manager == \Auth::id();
    }
    /**
     * Determine if a user can view project
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Projects\Entities\Project $project
     * @return bool
     */
    public function view(User $user, Project $project)
    {
        return $project->isTeam() || $project->isClient();
    }
    /**
     * Determine if a user can update project
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Projects\Entities\Project $project
     * @return bool
     */
    public function update(User $user, Project $project)
    {
        return $project->isTeam() || $project->manager == \Auth::id();
    }

    /**
     * Determine if a user can view project invoices
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Projects\Entities\Project $project
     * @return bool
     */
    public function invoices(User $user, Project $project)
    {
        return $project->isTeam() || $project->isClient() || \Auth::user()->can('invoices_view_all');
    }
    /**
     * Determine if a user can view project expenses
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Projects\Entities\Project $project
     * @return bool
     */
    public function expenses(User $user, Project $project)
    {
        return $project->isTeam() || $project->isClient() || \Auth::user()->can('expenses_view_all');
    }
    /**
     * Determine if a user can delete project
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Projects\Entities\Project $project
     * @return bool
     */
    public function delete(User $user, Project $project)
    {
        return $project->manager == \Auth::id();
    }
}
