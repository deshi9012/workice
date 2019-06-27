<?php

namespace Modules\Tickets\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tickets\Entities\Ticket;

class FeedbackRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(get_option('company_email'), get_option('company_name'))
            ->subject(langmail('tickets.survey.subject', ['code' => $this->ticket->code, 'subject' => $this->ticket->subject]))
            ->markdown('emails.tickets.survey');
    }
}
