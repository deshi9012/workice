<?php

namespace Modules\Projects\Observers;

use Modules\Projects\Entities\Project;
use Modules\Projects\Jobs\ComputeProject;
use Modules\Users\Entities\QuickAccess;

class ProjectObserver
{

    /**
     * Listen to Project creating event.
     *
     * @param Project $project
     */
    public function creating(Project $project)
    {
        $project->code = generateCode('projects');
        if (!request()->filled('settings')) {
            $project->settings = json_decode(get_option('default_project_settings'));
        }
        if (is_null($project->token)) {
            $project->token = genToken();
        }
    }
    /**
     * Listen to Project saving event.
     *
     * @param Project $project
     */
    public function saving(Project $project)
    {
        if (is_null($project->token)) {
            $project->token = genToken();
        }
    }

    /**
     * Listen to Project saved event.
     *
     * @param Project $project
     */
    public function saved(Project $project)
    {
        if (request()->has('tags')) {
            $project->retag(collect(request('tags'))->implode(','));
        }
        $project->assignTeam(request('team'));
        ComputeProject::dispatch($project)->onQueue('high');
    }

    /**
     * Listen to Project deleting event.
     *
     * @param Project $project
     */
    public function deleting(Project $project)
    {
        $project->tasks()->each(
            function ($task) {
                $task->delete();
            }
        );
        $project->milestones()->each(
            function ($milestone) {
                $milestone->delete();
            }
        );

        $project->issues()->each(
            function ($issue) {
                $issue->delete();
            }
        );

        $project->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );

        $project->expenses()->each(
            function ($expense) {
                $expense->delete();
            }
        );

        $project->invoices()->each(
            function ($invoice) {
                $invoice->delete();
            }
        );

        $project->files()->each(
            function ($file) {
                $file->delete();
            }
        );

        $project->links()->each(
            function ($link) {
                $link->delete();
            }
        );

        $project->tickets()->each(
            function ($ticket) {
                $ticket->delete();
            }
        );

        $project->schedules()->each(
            function ($event) {
                $event->delete();
            }
        );

        $project->todos()->each(
            function ($cl) {
                $cl->delete();
            }
        );

        $project->timesheets()->each(
            function ($tm) {
                $tm->delete();
            }
        );

        $project->activities()->each(
            function ($activity) {
                $activity->delete();
            }
        );

        $project->assignees()->each(
            function ($agent) {
                $agent->delete();
            }
        );
        $project->detag();
        QuickAccess::where('project_id', $project->id)->delete();
        \Cache::forget('quick-access-' . \Auth::id());
    }
}
