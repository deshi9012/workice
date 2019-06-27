<?php

namespace Modules\Timetracking\Listeners;

use Auth;

class TimerEventSubscriber
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
     * Timer created listener
     */
    public function onTimerCreated($event)
    {
        $event->timer->timeable->activities()->create(
            [
                'action' => 'activity_create_timer', 'icon'             => 'fa-clock-o', 'user_id' => $this->user,
                'value1' => secToHours($event->timer->worked), 'value2' => $event->timer->timeable->name,
                'url'    => $event->timer->timeable->url,
            ]
        );
    }

    /**
     * Timer updated listener
     */
    public function onTimerUpdated($event)
    {
        $event->timer->timeable->activities()->create(
            [
                'action' => 'activity_update_timer', 'icon'             => 'fa-pencil', 'user_id' => $this->user,
                'value1' => secToHours($event->timer->worked), 'value2' => $event->timer->timeable->name,
                'url'    => $event->timer->timeable->url,
            ]
        );
    }

    /**
     * Timer deleted listener
     */
    public function onTimerDeleted($event)
    {
        $event->timer->timeable->activities()->create(
            [
                'action' => 'activity_delete_timer', 'icon'             => 'fa-trash', 'user_id' => $this->user,
                'value1' => secToHours($event->timer->worked), 'value2' => $event->timer->timeable->name,
                'url'    => $event->timer->timeable->url,
            ]
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Timetracking\Events\TimerCreated',
            'Modules\Timetracking\Listeners\TimerEventSubscriber@onTimerCreated'
        );

        $events->listen(
            'Modules\Timetracking\Events\TimerUpdated',
            'Modules\Timetracking\Listeners\TimerEventSubscriber@onTimerUpdated'
        );
        $events->listen(
            'Modules\Timetracking\Events\TimerDeleted',
            'Modules\Timetracking\Listeners\TimerEventSubscriber@onTimerDeleted'
        );
    }
}
