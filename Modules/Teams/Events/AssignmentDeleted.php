<?php

namespace Modules\Teams\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Teams\Entities\Assignment;

class AssignmentDeleted
{
    use SerializesModels;

    public $assignment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
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
