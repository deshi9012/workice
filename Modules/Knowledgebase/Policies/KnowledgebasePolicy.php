<?php

namespace Modules\Knowledgebase\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Knowledgebase\Entities\Knowledgebase;
use Modules\Users\Entities\User;

class KnowledgebasePolicy
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
     * Determine if the user can update article
     *
     * @param  \Modules\Users\Entities\User                  $user
     * @param  \Modules\Knowledgebase\Entities\Knowledgebase $knowledgebase
     * @return bool
     */
    public function update(User $user, Knowledgebase $knowledgebase)
    {
        return $user->id === $knowledgebase->user_id;
    }
    /**
     * Determine if the user can delete article
     *
     * @param  \Modules\Users\Entities\User                  $user
     * @param  \Modules\Knowledgebase\Entities\Knowledgebase $knowledgebase
     * @return bool
     */
    public function delete(User $user, Knowledgebase $knowledgebase)
    {
        return $user->id === $knowledgebase->user_id;
    }
}
