<?php

namespace Modules\Comments\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Comments\Entities\Comment;
use Modules\Users\Entities\User;

class CommentPolicy
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
     * Determine if the given user can update a comment
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Comments\Entities\Comment $comment
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
    /**
     * Determine if user can delete a comment
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Comments\Entities\Comment $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
}
