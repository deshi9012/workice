<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;

class GuestController extends Controller
{
    protected $project;
    protected $request;

    public function __construct(Project $project, Request $request)
    {
        $this->project = $project;
        $this->request = $request;
    }
    public function feedback($token = null)
    {
        $project         = $this->project->whereToken($token)->first();
        $data['project'] = $project;
        $data['token']  = $token;

        return view('projects::feedback')->with($data);
    }

    public function rating($token = null)
    {
        if ($token) {
            $project = $this->project->whereToken($token)->first();
            $project->reviews()->updateOrCreate(
                ['user_id' => optional($project->company->contact)->id],
                [
                    'satisfied' => $this->request->rating,
                    'message' => $this->request->message,
                ]
            );
            $project->update(['rated' => 1]);

            $data['message']  = 'Your rating has been saved';
            $data['redirect'] = route('dashboard.index');
            toastr()->info('Thank you for your response', langapp('response_status'));

            return ajaxResponse($data);
        }
    }
}
