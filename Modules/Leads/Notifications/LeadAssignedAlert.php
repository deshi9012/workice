<?php

namespace Modules\Leads\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Leads\Entities\Lead;

class LeadAssignedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $lead;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
        $this->type = 'lead_assigned_alert';
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
            return $notifiable->notifyOn($this->type, ['mail']);
        }
        return [];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($notifiable->channelActive('mail', $this->type)) {
            return (new MailMessage)
                ->greeting(langmail('leads.assigned.greeting', ['name' => $notifiable->name]))
                ->line(
                    langmail(
                        'leads.assigned.body',
                        [
                            'name' => $this->lead->name,
                        ]
                    )
                )
                ->line(route('leads.view', $this->lead->id));
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage())
                ->success()
                ->content(langmail('leads.assigned.body', ['name' => $this->lead->name]))
                ->attachment(
                    function ($attachment) {
                        $attachment->title($this->lead->name, route('leads.view', $this->lead->id))
                            ->fields(
                                [
                                    langapp('company')    => $this->lead->company,
                                    langapp('source')     => $this->lead->AsSource->name,
                                    langapp('stage')      => $this->lead->status->name,
                                    langapp('lead_value') => $this->lead->computed_value,
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
                'subject'  => langmail('leads.assigned.subject'),
                'icon'     => 'headset',
                'activity' => langmail('leads.assigned.body', ['name' => $this->lead->name]),
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
                ->content(langmail('leads.assigned.body', ['name' => $this->lead->name]));
        }
    }
}
