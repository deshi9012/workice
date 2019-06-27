<?php

namespace Modules\Teams\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;

class TeamsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function remove($project = null, $member = null)
    {
        $data['project'] = $project;
        $data['member']  = $member;
        return view('teams::modal.remove')->with($data);
    }
    /**
     * Set project manager
     */
    public function manager($project = null, $member = null)
    {
        $project = Project::findOrFail($project);
        $project->update(['manager' => $member]);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));
        return redirect(url()->previous());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detach(Request $request)
    {
        $project    = Project::findOrFail($request->project_id);
        $assignment = $project->assignees()->whereUserId($request->member_id)->first();
        $assignment->delete();
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('projects.view', ['id' => $project->id]);

        return ajaxResponse($data);
    }
}
