<?php

namespace Modules\Tickets\Console;

use Illuminate\Console\Command;
use Modules\Tickets\Emails\FeedbackRequestMail;
use Modules\Tickets\Entities\Ticket;

class TicketFeedback extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tickets:feedback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send feedback requests for solved tickets.';
    protected $ticket;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        parent::__construct();
        $this->ticket = $ticket;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->ticket->closed()->where('rated', 0)->where('feedback_disabled', 0)->get() as $t) {
            if (get_option('ticket_feedback_after') > 0) {
                if (today()->diffInDays($t->closed_at) == get_option('ticket_feedback_after')) {
                    \Mail::to($t->user)->send(new FeedbackRequestMail($t));
                }
            }
        }
        $this->info('Ticket feedback requests sent successfully');
    }
}
