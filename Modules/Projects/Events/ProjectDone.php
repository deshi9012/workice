<?php

namespace Modules\Projects\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Projects\Entities\Project;

class ProjectDone
{
    use SerializesModels;

    public $project;
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project, $user_id)
    {
        $this->project = $project;
        $this->user_id = $user_id;
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
