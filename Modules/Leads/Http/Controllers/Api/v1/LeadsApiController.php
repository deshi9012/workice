<?php

namespace Modules\Leads\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Extras\Transformers\CallsResource;
use Modules\Leads\Entities\Lead;
use Modules\Leads\Events\LeadConverted;
use Modules\Leads\Http\Requests\LeadsRequest;
use Modules\Leads\Transformers\LeadResource;
use Modules\Leads\Transformers\LeadsResource;
use Modules\Todos\Transformers\TodosResource;

class LeadsApiController extends Controller
{
    /**
     * Lead Model
     *
     * @var \Modules\Leads\Entities\Lead
     */
    protected $lead;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->lead    = new Lead;
    }
    /**
     * Return JSON Leads
     */
    public function index()
    {
        $leads = new LeadsResource(
            $this->lead->whereNull('archived_at')->whereNull('converted_at')
                ->with(['AsSource:id,name', 'status:id,name', 'agent:id,email,name,username'])
                ->orderByDesc('id')
                ->paginate(50)
        );

        return response($leads, Response::HTTP_OK);
    }
    /**
     * Show Lead
     */
    public function show($id = null)
    {

        $lead = $this->lead->findOrFail($id);

        return response(new LeadResource($lead), Response::HTTP_OK);
    }
    /**
     * Save new lead
     */
    public function save(LeadsRequest $request)
    {
        logger('api start');
        logger($request);
        logger('api end');
        if(!$request->desk){
            $request->desk = 1;
        }
        $lead = $this->lead->firstOrCreate(['email' => $request->email, 'desk_id' => $request->desk], $request->except(['custom', 'tags']));

        logger($lead);
        return ajaxResponse(
            [
                'id'       => $lead->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('leads.view', $lead->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }
    /**
     * Update lead
     */
    public function update(LeadsRequest $request, $id = null)
    {

        $request->validate(['email' => 'unique:leads,email,'.$id]);
        $lead = $this->lead->findOrFail($id);
        $lead->update($request->except(['custom', 'tags']));
        $lead->update(['desk_id' => $request->all()['desk']]);
        return ajaxResponse(
            [
                'id'       => $lead->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('leads.view', $lead->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Convert lead to opportunity
     */
    public function convert($id)
    {
        $this->request->validate(['deal_title' => 'required', 'id' => 'required']);
        $lead = $this->lead->findOrFail($id);
        $data = $lead->toCustomer();
        event(new LeadConverted($lead, \Auth::id()));

        return ajaxResponse($data);
    }
    /**
     * Move lead to next stage
     */
    public function nextStage($id = null)
    {
        $this->request->validate(['stage' => 'required']);
        $lead = $this->lead->findOrFail($id);
        $lead->update(['stage_id' => $this->request->stage]);
        return ajaxResponse(
            [
                'id'       => $lead->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => $this->request->url,
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Move lead to specified stage
     */
    public function moveStage()
    {
        $target_id = \App\Entities\Category::whereName(humanize($this->request->target))->first()->id;
        $lead      = $this->lead->findOrFail($this->request->id);
        $lead->update(['stage_id' => $target_id]);
        return ajaxResponse(
            [
                'id'      => $lead->id,
                'message' => langapp('lead_stage_changed', ['name' => $lead->name, 'stage' => humanize($this->request->target)]),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calls($id = null)
    {
        $lead  = $this->lead->findOrFail($id);
        $calls = new CallsResource($lead->calls()->orderBy('id', 'desc')->paginate(50));
        return response($calls, Response::HTTP_OK);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todos($id = null)
    {
        $lead  = $this->lead->findOrFail($id);
        $todos = new TodosResource($lead->todos()->with(['agent:id,username,name'])->orderBy('id', 'desc')->paginate(50));
        return response($todos, Response::HTTP_OK);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comments($id = null)
    {
        $lead     = $this->lead->findOrFail($id);
        $comments = new CommentsResource($lead->comments()->orderBy('id', 'desc')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }
    /**
     * Delete a lead
     */
    public function delete($id = null)
    {
        $lead = $this->lead->findOrFail($id);
        $lead->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('leads.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
