<?php

namespace Modules\Issues\Observers;

use App\Entities\Status;
use Modules\Issues\Entities\Issue;

class IssueObserver
{

    /**
     * Listen to the Issue creating event.
     *
     * @param \Modules\Issues\Entities\Issue $issue
     */
    public function creating(Issue $issue)
    {
        if (empty($issue->status) || is_null($issue->status)) {
            $issue->status = 1;
        }
        if (!is_numeric($issue->status)) {
            $status        = Status::firstOrCreate(['status' => $issue->status], ['color' => '#fb6b5b']);
            $issue->status = $status->id;
        }

        $issue->code = generateCode('issues');
    }

    /**
     * Listen to the Issue saved event.
     *
     * @param \Modules\Issues\Entities\Issue $issue
     */
    public function saved(Issue $issue)
    {
        if (request()->has('tags')) {
            $issue->retag(collect(request('tags'))->implode(','));
        }
    }

    /**
     * Listen to the Client deleting event.
     *
     * @param \Modules\Issues\Entities\Issue $issue
     */
    public function deleting(Issue $issue)
    {
        foreach ($issue->files as $file) {
            $file->delete();
        }
        foreach ($issue->comments as $comment) {
            $comment->delete();
        }
        foreach ($issue->vault as $vault) {
            $vault->delete();
        }
        $issue->detag();
    }
}
{

}
