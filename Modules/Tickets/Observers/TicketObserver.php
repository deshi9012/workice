<?php

namespace Modules\Tickets\Observers;

use App\Entities\Status;
use Modules\Tickets\Entities\Ticket;
use Modules\Tickets\Events\TicketClosed;
use Modules\Tickets\Jobs\AnswerBot;

class TicketObserver
{

    /**
     * Listen to the Ticket created event.
     *
     * @param Ticket $ticket
     */
    public function creating(Ticket $ticket)
    {
        $ticket->token    = genToken();
        $ticket->code     = generateCode('tickets');
        $ticket->due_date = now()->addDays(get_option('ticket_due_after'));
        if (!empty($ticket->status) && !is_numeric($ticket->status)) {
            $ticket->status = Status::firstOrCreate(['status' => $ticket->status], ['color' => '#c7254e'])->id;
        }
    }

    /**
     * Listen to the Ticket saving event.
     *
     * @param Ticket $ticket
     */
    public function saving(Ticket $ticket)
    {
        $ticket->user_id = $ticket->user_id > 0 ? $ticket->user_id : 1;
        if (request()->has('user_id')) {
            $ticket->user_id = request('user_id');
        }
    }

    /**
     * Listen to the Ticket saved event.
     *
     * @param Ticket $ticket
     */
    public function saved(Ticket $ticket)
    {
        if (request()->has('tags')) {
            $ticket->retag(collect(request('tags'))->implode(','));
        }
        $ticket->saveCustom(request('custom'));
        if ($ticket->status == \App\Entities\Status::whereStatus('closed')->first()->id) {
            event(new TicketClosed($ticket, \Auth::check() ? \Auth::id() : 1));
        }
    }

    /**
     * Listen to the Ticket created event.
     *
     * @param Ticket $ticket
     */
    public function created(Ticket $ticket)
    {
        settingEnabled('answerbot_active') ? AnswerBot::dispatch($ticket)->onQueue('low') : '';
    }

    /**
     * Listen to the Ticket deleting event.
     *
     * @param Ticket $ticket
     */
    public function deleting(Ticket $ticket)
    {
        $ticket->unsetEventDispatcher();
        $ticket->comments()->each(
            function ($comment) {
                $comment->delete();
            }
        );

        $ticket->activities()->each(
            function ($log) {
                $log->delete();
            }
        );
        $ticket->files()->each(
            function ($file) {
                $file->delete();
            }
        );
        $ticket->custom()->each(
            function ($extra) {
                $extra->delete();
            }
        );
        $ticket->detag();
    }
}
