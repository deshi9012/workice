<?php

namespace Modules\Milestones\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Milestones\Entities\Milestone;
use Modules\Milestones\Http\Requests\MilestoneRequest;
use Modules\Projects\Entities\Project;

class MilestonesController extends Controller
{
    public function edit(Milestone $milestone)
    {
        $data['milestone'] = $milestone;

        return view('milestones::update')->with($data);
    }

    public function update(MilestoneRequest $request, Milestone $milestone)
    {
        $milestone->update($request->except('id'));
        $data['message'] = langapp('changes_saved_successful');
        $data['redirect'] = route('projects.view', ['id' => $milestone->project_id, 'tab' => 'milestones', 'item' => $milestone->id]);

        return ajaxResponse($data);
    }

    public function create(Project $project)
    {
        $data['project'] = $project;

        return view('milestones::create')->with($data);
    }

    public function save(MilestoneRequest $request)
    {
        $milestone = Milestone::create($request->all());
        $data['message'] = langapp('saved_successfully');
        $data['redirect'] = route('projects.view', ['id' => $milestone->project_id, 'tab' => 'milestones']);

        return ajaxResponse($data);
    }

    public function delete(Milestone $milestone)
    {
        $data['milestone'] = $milestone;

        return view('milestones::delete')->with($data);
    }

    public function destroy(Request $request, Milestone $milestone)
    {
        $milestone->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect()->route('projects.view', ['id' => $milestone->project_id, 'tab' => 'milestones']);
    }
}
