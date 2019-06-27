<?php

namespace Modules\Tasks\Observers;

use Modules\Tasks\Entities\Task;
use Modules\Users\Entities\QuickAccess;

class TaskObserver
{
    
    /**
     * Listen to the Task saving event.
     *
     * @param Task $task
     */
    public function saving(Task $task)
    {
        $task->time        = $task->totalTime();
        $task->hourly_rate = $task->hourly_rate > 0 ? $task->hourly_rate : $task->AsProject->hourly_rate;
        if (empty($task->stage_id) || is_null($task->stage_id)) {
            $task->stage_id = \App\Entities\Category::firstOrCreate(['name' => 'Backlog', 'module' => 'tasks'])->id;
        }
    }

    /**
     * Listen to the Task saved event.
     *
     * @param Task $task
     */
    public function saved(Task $task)
    {
        if (request()->has('tags')) {
            $task->retag(collect(request('tags'))->implode(','));
        }
        $task->assignTeam(request('team'));
        $task->AsProject->startComputeJob();
    }

    /**
     * Listen to Task deleting event.
     *
     * @param Task $task
     */
    public function deleting(Task $task)
    {
        $task->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );

        $task->files()->each(
            function ($file) {
                $file->delete();
            }
        );
        $task->timesheets()->each(
            function ($entry) {
                $entry->delete();
            }
        );
        $task->assignees()->each(
            function ($team) {
                $team->delete();
            }
        );
        $task->detag();
        QuickAccess::where('task_id', $task->id)->delete();
        \Cache::forget('quick-access-' . \Auth::id());
    }
}
