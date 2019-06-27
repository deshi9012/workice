<?php

namespace Modules\Tasks\Listeners;

use App\Services\EventCreatorFactory;
use Modules\Tasks\Notifications\TaskCreatedAlert;

class TaskEventSubscriber
{
    protected $user;
    protected $eventCreator;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EventCreatorFactory $eventfactory)
    {
        $this->user         = \Auth::id() ?? 1;
        $this->eventCreator = new \App\Services\EventCreator($eventfactory, 'tasks');
    }

    /**
     * Task created listener
     */
    public function onTaskCreated($event)
    {
        $event->task->AsProject->activities()->create(
            [
                'action' => 'activity_create_task', 'icon' => 'fa-tasks', 'user_id' => $this->user,
                'value1' => $event->task->name, 'value2'   => $event->task->AsProject->name,
                'url'    => $event->task->url,
            ]
        );
        $this->eventCreator->logEvent($event->task);
    }

    /**
     * Task updated listener
     */
    public function onTaskUpdated($event)
    {
        $event->task->AsProject->activities()->create(
            [
                'action' => 'activity_update_task', 'icon' => 'fa-pencil', 'user_id' => $this->user,
                'value1' => $event->task->name, 'value2'   => $event->task->AsProject->name,
                'url'    => $event->task->url,
            ]
        );
        $this->eventCreator->logEvent($event->task);
    }

    /**
     * Task deleted listener
     */
    public function onTaskDeleted($event)
    {
        $event->task->AsProject->activities()->create(
            [
                'action' => 'activity_delete_task', 'icon' => 'fa-trash', 'user_id' => $this->user,
                'value1' => $event->task->name, 'value2'   => $event->task->time,
                'url'    => $event->task->url,
            ]
        );
        $this->eventCreator->deleteEvent($event->task);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Tasks\Events\TaskCreated',
            'Modules\Tasks\Listeners\TaskEventSubscriber@onTaskCreated'
        );

        $events->listen(
            'Modules\Tasks\Events\TaskUpdated',
            'Modules\Tasks\Listeners\TaskEventSubscriber@onTaskUpdated'
        );
        $events->listen(
            'Modules\Tasks\Events\TaskDeleted',
            'Modules\Tasks\Listeners\TaskEventSubscriber@onTaskDeleted'
        );
    }
}
