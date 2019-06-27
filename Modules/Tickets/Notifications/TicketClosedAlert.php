<?php

namespace Modules\Tickets\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Tickets\Emails\TicketClosedMail;
use Modules\Tickets\Entities\Ticket;

class TicketClosedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $ticket;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->type   = 'ticket_closed_alert';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($notifiable->notificationActive($this->type)) {
            return $notifiable->notifyOn($this->type, ['mail', 'database']);
        }
        return [];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return TicketClosedMail
     */
    public function toMail($notifiable)
    {
        if ($notifiable->channelActive('mail', $this->type)) {
            return (new TicketClosedMail($this->ticket, $notifiable->name))->to($notifiable->email);
        }
    }

    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage())
                ->success()
                ->content(
                    langmail(
                        'tickets.closed.body',
                        [
                            'subject' => $this->ticket->subject,
                        ]
                    )
                )
                ->attachment(
                    function ($attachment) {
                        $attachment->title($this->ticket->subject, route('tickets.view', $this->ticket->id))
                            ->fields(
                                [
                                    'ID #'                => $this->ticket->code,
                                    langapp('reporter')   => $this->ticket->user->name,
                                    langapp('department') => $this->ticket->dept->deptname,
                                    langapp('status')     => $this->ticket->AsStatus->status,
                                ]
                            );
                    }
                );
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($notifiable->channelActive('database', $this->type)) {
            return [
                'subject'  => langmail('tickets.closed.subject', ['code' => $this->ticket->code, 'subject' => $this->ticket->subject]),
                'icon'     => 'check-circle',
                'activity' => langmail('tickets.closed.body', ['subject' => $this->ticket->subject]),
            ];
        }
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        if ($notifiable->channelActive('nexmo', $this->type)) {
            return (new NexmoMessage)
                ->content(langmail('tickets.closed.body', ['subject' => $this->ticket->subject]));
        }
    }
}
