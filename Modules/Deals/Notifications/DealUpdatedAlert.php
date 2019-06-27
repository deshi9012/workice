<?php

namespace Modules\Deals\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Deals\Entities\Deal;

class DealUpdatedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $deal;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Deal $deal)
    {
        $this->deal = $deal;
        $this->type = 'deal_updated_alert';
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
                ->greeting(langmail('deals.updated.greeting', ['name' => $notifiable->name]))
                ->line(
                    langmail(
                        'deals.updated.body',
                        [
                            'title' => $this->deal->title,
                            'user'  => $notifiable->name,
                        ]
                    )
                )
                ->action('View Deal', route('deals.view', $this->deal->id));
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
                ->content(langmail('deals.updated.body', ['title' => $this->deal->title, 'user' => $notifiable->name]))
                ->attachment(
                    function ($attachment) {
                        $attachment->title($this->deal->title, route('deals.view', $this->deal->id))
                            ->fields(
                                [
                                    langapp('company')    => $this->deal->company->name,
                                    langapp('pipeline')   => $this->deal->pipe->name,
                                    langapp('stage')      => $this->deal->category->name,
                                    langapp('deal_value') => $this->deal->computed_value,
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
                'subject'  => langmail('deals.updated.subject'),
                'icon'     => 'pencil-alt',
                'activity' => langmail('deals.updated.body', ['title' => $this->deal->title, 'user' => $notifiable->name]),
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
                ->content(langmail('deals.updated.body', ['title' => $this->deal->title, 'user' => $notifiable->name]));
        }
    }
}
