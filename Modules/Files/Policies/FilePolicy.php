<?php

namespace Modules\Files\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Files\Entities\FileUpload;
use Modules\Users\Entities\User;

class FilePolicy
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
     * Determine if user can update file
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Files\Entities\FileUpload $file
     * @return bool
     */
    public function update(User $user, FileUpload $file)
    {
        return $user->id == $file->user_id;
    }
    /**
     * Determine if user can delete file
     *
     * @param  \Modules\Users\Entities\User       $user
     * @param  \Modules\Files\Entities\FileUpload $file
     * @return bool
     */
    public function delete(User $user, FileUpload $file)
    {
        return $user->id == $file->user_id || can('files_delete');
    }
}
