<?php

namespace Modules\Milestones\Observers;

use Modules\Milestones\Entities\Milestone;

class MilestoneObserver
{

    /**
     * Listen to Milestone created event.
     *
     * @param \Modules\Milestones\Entities\Milestone $milestone
     */
    public function creating(Milestone $milestone)
    {
    }

    /**
     * Listen to Milestone deleting event.
     *
     * @param \Modules\Milestones\Entities\Milestone $milestone
     */
    public function deleting(Milestone $milestone)
    {
        $milestone->tasks->each(
            function ($task) {
                $task->update(['milestone' => 0]);
            }
        );
    }
}
