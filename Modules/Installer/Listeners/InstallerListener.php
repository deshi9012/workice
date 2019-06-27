<?php

namespace Modules\Installer\Listeners;

use Artisan;
use DB;
use Exception;
use Modules\Users\Entities\User;

class InstallerListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Artisan::call('passport:install');

        DB::beginTransaction();
        try {
            $user    = User::create(cache('user_account'));
            $account = $user->profile->update(cache('profile_account'));
            DB::commit();
            $user->syncRoles('admin');
        } catch (Exception $e) {
            DB::rollBack();
        }
        try {
            Artisan::call('storage:link');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
