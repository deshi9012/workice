<?php

namespace Modules\Issues\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Issues\Entities\Issue;
use Modules\Issues\Http\Requests\IssueRequest;

class IssuesApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Issue Model
     *
     * @var \Modules\Issues\Entities\Issue
     */
    protected $issue;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->issue   = new Issue;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('issues::index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Issues\Http\Requests\IssueRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(IssueRequest $request)
    {
        $issue = $this->issue->create($request->except(['tags']));

        return ajaxResponse(
            [
                'id'       => $issue->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => $request->url,
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Issues\Http\Requests\IssueRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(IssueRequest $request, $id)
    {
        $issue = $this->issue->findOrFail($id);
        $issue->update($request->except(['tags', 'project_id']));

        return ajaxResponse(
            [
                'id'       => $issue->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => $request->url,
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Change issue status
     */
    public function status($id)
    {
        $this->request->validate(['status' => 'required|numeric']);
        $issue = $this->issue->findOrFail($id);
        $issue->update(['status' => $this->request->status]);
        return ajaxResponse(
            [
                'id'       => $issue->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => $this->request->url,
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function ajaxStatus()
    {
        $this->request->validate(['status' => 'required|numeric']);
        $issue = $this->issue->findOrFail($this->request->id);
        $issue->update(['status' => $this->request->status]);
        return langapp('changes_saved_successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $issue = $this->issue->findOrFail($id);
        $issue->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('projects.view', ['project' => $issue->project_id, 'tab' => 'issues']),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
