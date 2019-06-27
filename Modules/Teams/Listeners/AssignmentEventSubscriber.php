<?php

namespace Modules\Teams\Listeners;

use Auth;

class AssignmentEventSubscriber
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
     * Assignment Deleted
     */
    public function onAssignmentDeleted($event)
    {
        $event->assignment->assignable->activities()->create(
            [
                'action' => 'activity_team_removed', 'icon'          => 'fa-user-slash', 'user_id' => $this->user,
                'value1' => $event->assignment->user->name, 'value2' => $event->assignment->assignable->name,
                'url'    => $event->assignment->assignable->url,
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
            'Modules\Teams\Events\AssignmentDeleted',
            'Modules\Teams\Listeners\AssignmentEventSubscriber@onAssignmentDeleted'
        );
    }
}
