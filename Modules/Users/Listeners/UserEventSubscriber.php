<?php

namespace Modules\Users\Listeners;

use App;
use Auth;
use Cache;
use Google2FA;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Users\Entities\User;
use Modules\Users\Notifications\NewSignUp;

class UserEventSubscriber
{
    protected $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::check() ? Auth::id() : 1;
    }

    /**
     * User created listener
     */
    public function onUserCreated($event)
    {
        $data = [
            'action' => 'activity_create_user', 'icon' => 'fa-user-circle', 'user_id' => $this->user,
            'value1' => $event->user->name, 'value2'   => '',
            'url'    => $event->user->url,
        ];
        $event->user->activities()->create($data);
    }

    /**
     * User updated listener
     */
    public function onUserUpdated($event)
    {
        $data = [
            'action' => 'activity_update_user', 'icon' => 'fa-pencil', 'user_id' => $this->user,
            'value1' => $event->user->name, 'value2'   => '',
            'url'    => $event->user->url,
        ];
        $event->user->activities()->create($data);
    }

    /**
     * User deleted listener
     */
    public function onUserDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_user', 'icon' => 'fa-trash', 'user_id' => $this->user,
            'value1' => $event->user->name, 'value2'   => '',
            'url'    => $event->user->url,
        ];
        Auth::user()->activities()->create($data);
    }

    /**
     * User login listener
     */
    public function onUserLogin($event)
    {
        $event->user->unsetEventDispatcher();
        if (is_null($event->user->last_login)) {
            session(['show_tour' => true]);
        }
        $event->user->update(
            [
                'last_ip'    => request()->ip(),
                'last_login' => now(),
            ]
        );
        session(['last_reauth' => strtotime('now')]);
    }
    public function onUserRegistered($event)
    {
        \Notification::send(User::role('admin')->get(), new NewSignUp($event->user));
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        if (settingEnabled('stop_timer_logout')) {
            $timers = TimeEntry::where(['started_by' => Auth::id(), 'is_started' => 1])->get();
            foreach ($timers as $timer) {
                $timer->timeable->stopClock();
            }
            Cache::forget('running-timers-' . Auth::id());
        }
        Cache::forget('workice-main-menu-' . Auth::id());
        Cache::forget('quick-access-' . Auth::id());
        Cache::forget('todo-today-count-' . Auth::id());
        Cache::forget('running-timers-' . Auth::id());
        if (!App::runningInConsole()) {
            Google2FA::logout();
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Users\Events\UserCreated',
            'Modules\Users\Listeners\UserEventSubscriber@onUserCreated'
        );
        $events->listen(
            'Modules\Users\Events\UserUpdated',
            'Modules\Users\Listeners\UserEventSubscriber@onUserUpdated'
        );
        $events->listen(
            'Modules\Users\Events\UserDeleted',
            'Modules\Users\Listeners\UserEventSubscriber@onUserDeleted'
        );
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'Modules\Users\Listeners\UserEventSubscriber@onUserLogin'
        );
        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'Modules\Users\Listeners\UserEventSubscriber@onUserLogout'
        );
        $events->listen(
            'Illuminate\Auth\Events\Registered',
            'Modules\Users\Listeners\UserEventSubscriber@onUserRegistered'
        );
    }
}
