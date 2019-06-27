<?php

namespace Modules\Tickets\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tickets\Entities\Ticket;

class AnswerBotMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;

    public $articles;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket, $articles)
    {
        $this->ticket = $ticket;
        $this->articles = $articles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(get_option('company_email'), get_option('company_name'))
            ->subject(langmail('tickets.answer.subject', ['code' => $this->ticket->code, 'subject' => $this->ticket->subject]))
            ->markdown('emails.tickets.answerbot');
    }
}
