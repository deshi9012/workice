<?php

namespace Modules\Issues\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Issues\Entities\Issue;

class IssueDeleted
{
    use SerializesModels;

    public $issue;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
