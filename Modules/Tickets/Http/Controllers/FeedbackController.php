<?php

namespace Modules\Tickets\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Tickets\Entities\Ticket;

class FeedbackController extends Controller
{
    protected $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function feedback(Ticket $ticket)
    {
        $data['ticket'] = $ticket;
        return view('tickets::feedback')->with($data);
    }

    public function rating(Ticket $ticket)
    {
        $ticket->reviews()->updateOrCreate(
            ['user_id' => $ticket->user->id],
            [
            'satisfied' => $this->request->rating, 'message' => $this->request->message,
            'agent_id' => $ticket->assignee
            ]
        );
        $ticket->unsetEventDispatcher();
        $ticket->update(['rated' => 1]);

        $data['message']  = 'Your rating has been saved';
        $data['redirect'] = \URL::signedRoute('tickets.feedback', $ticket->id);
        toastr()->info('Thank you for your response', langapp('response_status'));

        return ajaxResponse($data);
    }
}
