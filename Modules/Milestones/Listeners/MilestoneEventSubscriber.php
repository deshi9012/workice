<?php

namespace Modules\Milestones\Listeners;

class MilestoneEventSubscriber
{
    protected $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = \Auth::id() ?? 1;
    }

    /**
     * Milestone created listener
     */
    public function onMilestoneCreated($event)
    {
        $event->milestone->AsProject->activities()->create(
            [
                'action' => 'activity_create_milestone', 'icon'         => 'fa-maps-signs', 'user_id' => $this->user,
                'value1' => $event->milestone->milestone_name, 'value2' => $event->milestone->AsProject->name,
                'url'    => $event->milestone->url,
            ]
        );
    }

    /**
     * Milestone updated listener
     */
    public function onMilestoneUpdated($event)
    {
        $event->milestone->AsProject->activities()->create(
            [
                'action' => 'activity_update_milestone', 'icon'         => 'fa-pencil-alt', 'user_id' => $this->user,
                'value1' => $event->milestone->milestone_name, 'value2' => $event->milestone->AsProject->name,
                'url'    => $event->milestone->url,
            ]
        );
    }

    /**
     * Milestone deleted listener
     */
    public function onMilestoneDeleted($event)
    {
        $event->milestone->AsProject->activities()->create(
            [
                'action' => 'activity_delete_milestone', 'icon'         => 'fa-trash-alt', 'user_id' => $this->user,
                'value1' => $event->milestone->milestone_name, 'value2' => $event->milestone->AsProject->name,
                'url'    => $event->milestone->url,
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
            'Modules\Milestones\Events\MilestoneCreated',
            'Modules\Milestones\Listeners\MilestoneEventSubscriber@onMilestoneCreated'
        );

        $events->listen(
            'Modules\Milestones\Events\MilestoneUpdated',
            'Modules\Milestones\Listeners\MilestoneEventSubscriber@onMilestoneUpdated'
        );
        $events->listen(
            'Modules\Milestones\Events\MilestoneDeleted',
            'Modules\Milestones\Listeners\MilestoneEventSubscriber@onMilestoneDeleted'
        );
    }
}
