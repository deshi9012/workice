<?php

namespace Modules\Tickets\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Tickets\Emails\TicketRepliedMail;
use Modules\Tickets\Entities\Ticket;

class TicketRepliedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $ticket;
    public $comment;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, $comment)
    {
        $this->ticket  = $ticket;
        $this->comment = $comment;
        $this->type    = 'ticket_replied_alert';
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
            return $notifiable->notifyOn($this->type, ['slack', 'database', 'mail']);
        }
        return [];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return TicketRepliedMail
     */
    public function toMail($notifiable)
    {
        if ($notifiable->channelActive('mail', $this->type)) {
            return (new TicketRepliedMail($this->ticket, $notifiable->name, $this->comment))->to($notifiable->email);
        }
    }

    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage())
                ->success()
                ->content(
                    langmail(
                        'tickets.replied.body',
                        [
                            'code' => $this->ticket->code,
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
                'subject'  => langmail('tickets.replied.subject', ['code' => $this->ticket->code, 'subject' => $this->ticket->subject]),
                'icon'     => 'reply',
                'activity' => langmail('tickets.replied.body', ['code' => $this->ticket->code]),
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
                ->content(langmail('tickets.replied.body', ['code' => $this->ticket->code]));
        }
    }
}
