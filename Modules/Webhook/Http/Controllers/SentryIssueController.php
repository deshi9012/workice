<?php

namespace Modules\Webhook\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;

class SentryIssueController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function incoming($token = null)
    {
        $project      = Project::where('token', $token)->first();
        $issueCreator = $project->assignees()->inRandomOrder()->first();
        Auth::onceUsingId($issueCreator->user_id);
        $issue = $project->issues()->create([
            'user_id'         => $issueCreator->user_id,
            'assignee'        => $issueCreator->user_id,
            'subject'         => 'Sentry Issue ID ' . $this->request->event['event_id'],
            'reproducibility' => 'Error in file ' . $this->request->event['metadata']['filename'],
            'severity'        => langapp('major'),
            'priority'        => 'high',
            'description'     => $this->request->event['metadata']['value'],
            'status'          => 1,
            'meta'            => [
                'url'       => $this->request->url,
                'location'  => $this->request->location,
                'timestamp' => $this->request->event['timestamp'],
                'tags'      => $this->request->event['tags'],
            ],
        ]);
        $issue->tag(['sentry']);
        Auth::logout();
    }
}
