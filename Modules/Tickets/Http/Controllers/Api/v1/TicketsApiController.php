<?php

namespace Modules\Tickets\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Files\Helpers\Uploader;
use Modules\Tickets\Entities\Ticket;
use Modules\Tickets\Events\TicketUpdated;
use Modules\Tickets\Http\Requests\TicketRequest;
use Modules\Tickets\Notifications\TicketStatusAlert;
use Modules\Tickets\Transformers\TicketResource;
use Modules\Tickets\Transformers\TicketsResource;

class TicketsApiController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    public $request;
    /**
     * Ticket Model
     *
     * @var Ticket
     */
    public $ticket;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->ticket  = new Ticket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $tickets = new TicketsResource(
            $this->ticket->with(['AsStatus:id,status', 'dept:deptid,deptname', 'AsPriority:id,priority', 'agent:id,username,name'])
                ->orderByDesc('id')
                ->paginate(50)
        );
        return response($tickets, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($id = null)
    {
        $ticket = $this->ticket->findOrFail($id);
        $this->authorize('show', $ticket);
        return response(new TicketResource($ticket), Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function comments($id = null)
    {
        $ticket = $this->ticket->findOrFail($id);
        $this->authorize('show', $ticket);
        $comments = new CommentsResource($ticket->comments()->orderBy('id', 'desc')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }
    /**
     * Save ticket
     */
    public function save(TicketRequest $request)
    {
        $ticket = $this->ticket->create($request->except(['custom', 'tags', 'uploads']));

        if ($request->hasFile('uploads')) {
            $this->makeUploads($ticket, $request);
        }
        return ajaxResponse(
            [
                'id'       => $ticket->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('tickets.view', $ticket->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }
    /**
     * Update ticket
     */
    public function update(TicketRequest $request, $id = null)
    {
        $ticket = $this->ticket->findOrFail($id);
        $this->authorize('update', $ticket);
        $ticket->update($request->except(['id', 'code', 'custom', 'tags', 'uploads']));
        event(new TicketUpdated($ticket));

        if ($request->hasFile('uploads')) {
            $this->makeUploads($ticket, $request);
        }
        return ajaxResponse(
            [
                'id'       => $ticket->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('tickets.view', $ticket->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Modify ticket status
     */
    public function status($id = null)
    {
        $this->request->validate(['status' => 'required|numeric']);
        $ticket = $this->ticket->findOrFail($id);
        $this->authorize('update', $ticket);
        $ticket->update(['status' => $this->request->status]);
        event(new TicketUpdated($ticket));
        
        return ajaxResponse(
            [
                'id'       => $ticket->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('tickets.view', $ticket->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    protected function makeUploads($ticket, $request)
    {
        $request->request->add(['module' => 'tickets']);
        $request->request->add(['module_id' => $ticket->id]);
        $request->request->add(['title' => $ticket->subject]);
        $request->request->add(['description' => 'Ticket ' . $ticket->subject . ' file']);

        return (new Uploader)->save('uploads/tickets', $request);
    }
    /**
     * Delete ticket
     */
    public function delete($id = null)
    {
        $ticket = $this->ticket->findOrFail($id);
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('tickets.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
