<?php

namespace Modules\Leads\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Leads\Entities\Lead;

class LeadCommented extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Lead Model
     *
     * @var \Modules\Leads\Entities\Lead
     */
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
        $this->type = 'lead_commented';
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
            return $notifiable->notifyOn($this->type, ['slack', 'database']);
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
                ->subject(langmail('leads.commented.subject'))
                ->greeting(langmail('leads.commented.greeting', ['name' => $notifiable->name]))
                ->line(langmail('leads.commented.body', ['name' => $this->lead->name]))
                ->line(route('leads.view', $this->lead->id));
        }
    }

    /*
    Send slack notification
     */
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content(
                    langmail(
                        'leads.commented.body',
                        [
                            'name' => $this->lead->name,
                        ]
                    )
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
                'subject'  => langmail('leads.commented.subject'),
                'icon'     => 'comments',
                'activity' => langmail(
                    'leads.commented.body',
                    [
                        'name' => $this->lead->name,
                    ]
                ),
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
                ->content(langmail(
                    'leads.commented.body',
                    [
                        'name' => $this->lead->name,
                    ]
                ));
        }
    }
}
