<?php

namespace Modules\Issues\Listeners;

use Auth;
use Modules\Issues\Notifications\IssueChangedAlert;
use Modules\Issues\Notifications\IssueCreatedAlert;

class IssueEventSubscriber
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
     * Issue created listener
     */
    public function onIssueCreated($event)
    {
        $event->issue->AsProject->activities()->create(
            [
                'action' => 'activity_create_issue', 'icon'  => 'fa-question', 'user_id' => $this->user,
                'value1' => $event->issue->subject, 'value2' => $event->issue->AsProject->name,
                'url'    => $event->issue->url,
            ]
        );
        if ($event->issue->assignee > 0) {
            $event->issue->agent->notify(new IssueCreatedAlert($event->issue));
        }
        $event->issue->user->notify(new IssueCreatedAlert($event->issue));
    }

    /**
     * Issue updated listener
     */
    public function onIssueUpdated($event)
    {
        $event->issue->AsProject->activities()->create(
            [
                'action' => 'activity_update_issue', 'icon'  => 'fa-pencil-alt', 'user_id' => $this->user,
                'value1' => $event->issue->subject, 'value2' => $event->issue->AsProject->name,
                'url'    => $event->issue->url,
            ]
        );
        if ($event->issue->assignee > 0) {
            $event->issue->agent->notify(new IssueChangedAlert($event->issue));
        }
        $event->issue->user->notify(new IssueChangedAlert($event->issue));
    }

    /**
     * Issue deleted listener
     */
    public function onIssueDeleted($event)
    {
        $event->issue->AsProject->activities()->create(
            [
                'action' => 'activity_delete_issue', 'icon'  => 'fa-trash', 'user_id' => $this->user,
                'value1' => $event->issue->subject, 'value2' => $event->issue->AsProject->name,
                'url'    => $event->issue->url,
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
            'Modules\Issues\Events\IssueCreated',
            'Modules\Issues\Listeners\IssueEventSubscriber@onIssueCreated'
        );

        $events->listen(
            'Modules\Issues\Events\IssueUpdated',
            'Modules\Issues\Listeners\IssueEventSubscriber@onIssueUpdated'
        );
        $events->listen(
            'Modules\Issues\Events\IssueDeleted',
            'Modules\Issues\Listeners\IssueEventSubscriber@onIssueDeleted'
        );
    }
}
