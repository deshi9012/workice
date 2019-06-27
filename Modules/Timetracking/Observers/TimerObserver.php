<?php

namespace Modules\Timetracking\Observers;

use Modules\Timetracking\Entities\TimeEntry;

class TimerObserver
{
    /**
     * Listen to the Timer saving event.
     *
     * @param TimeEntry $entry
     */
    public function saving(TimeEntry $entry)
    {
        $entry->total = request()->has('total') ? timelog($entry->total) : $entry->total;
    }
    /**
     * Listen to the Timer saving event.
     *
     * @param TimeEntry $entry
     */
    public function saved(TimeEntry $entry)
    {
        $entry->timeable->startComputeJob();
        if ($entry->task_id > 0) {
            $entry->task->unsetEventDispatcher();
            $entry->task->compute();
        }
    }
}
