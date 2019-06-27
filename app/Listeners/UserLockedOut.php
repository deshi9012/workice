<?php

namespace App\Listeners;

use App\Notifications\LockedOut;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Users\Entities\User;

class UserLockedOut
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
     * @param  \Illuminate\Auth\Events\Lockout $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        if ($user = User::where('email', $event->request->email)->first()) {
            $user->notify(new LockedOut);
        }
    }
}
