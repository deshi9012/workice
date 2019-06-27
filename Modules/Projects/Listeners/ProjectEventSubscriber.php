<?php

namespace Modules\Projects\Listeners;

use App\Services\EventCreatorFactory;
use Modules\Projects\Jobs\SendFeedbackRequest;

class ProjectEventSubscriber
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
        $this->eventCreator = new \App\Services\EventCreator($eventfactory, 'projects');
    }

    /**
     * Project created listener
     */
    public function onProjectCreated($event)
    {
        $event->project->activities()->create(
            [
                'action' => 'activity_create_project', 'icon' => 'fa-cubes', 'user_id' => $this->user,
                'value1' => $event->project->name, 'value2'   => optional($event->project->company)->name,
                'url'    => $event->project->url,
            ]
        );
        $this->eventCreator->logEvent($event->project);
    }
    /**
     * Project updated listener
     */
    public function onProjectUpdated($event)
    {
        $event->project->activities()->create(
            [
                'action' => 'activity_update_project', 'icon' => 'fa-pencil', 'user_id' => $this->user,
                'value1' => $event->project->name, 'value2'   => optional($event->project->company)->name,
                'url'    => $event->project->url,
            ]
        );
        $this->eventCreator->logEvent($event->project);
    }
    /**
     * Project Done listener
     */
    public function onProjectDone($event)
    {
        $event->project->update(
            [
                'progress' => 100, 'auto_progress' => 0, 'status' => 'Done',
            ]
        );
        foreach ($event->project->tasks as $task) {
            $task->unsetEventDispatcher();
            $task->update(['progress' => 100]);
        }

        $event->project->activities()->create(
            [
                'action' => 'activity_close_project', 'icon' => 'fa-check-circle', 'user_id' => $event->user_id,
                'value1' => $event->project->name, 'value2'  => $event->project->company->name,
                'url'    => $event->project->url,
            ]
        );
        if ($event->project->feedback_disabled == 0) {
            SendFeedbackRequest::dispatch($event->project)->onQueue('low');
        }
    }

    /**
     * Project deleted listener
     */
    public function onProjectDeleted($event)
    {
        $event->project->activities()->create(
            [
                'action' => 'activity_delete_project', 'icon' => 'fa-trash', 'user_id' => $this->user,
                'value1' => $event->project->name, 'value2'   => formatCurrency($event->project->currency, $event->project->sub_total),
                'url'    => $event->project->url,
            ]
        );
        $this->eventCreator->deleteEvent($event->project);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Projects\Events\ProjectCreated',
            'Modules\Projects\Listeners\ProjectEventSubscriber@onProjectCreated'
        );

        $events->listen(
            'Modules\Projects\Events\ProjectUpdated',
            'Modules\Projects\Listeners\ProjectEventSubscriber@onProjectUpdated'
        );
        $events->listen(
            'Modules\Projects\Events\ProjectDone',
            'Modules\Projects\Listeners\ProjectEventSubscriber@onProjectDone'
        );
        $events->listen(
            'Modules\Projects\Events\ProjectDeleted',
            'Modules\Projects\Listeners\ProjectEventSubscriber@onProjectDeleted'
        );
    }
}
