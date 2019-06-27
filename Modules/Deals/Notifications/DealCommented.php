<?php

namespace Modules\Deals\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Deals\Entities\Deal;

class DealCommented extends Notification
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
        $this->type = 'deal_commented';
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
                ->greeting(langmail('deals.commented.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('deals.commented.subject'))
                ->line(langmail('deals.commented.body', ['title' => $this->deal->title, 'contact' => optional($this->deal->contact)->name]))
                ->action('View Deal', route('deals.view', $this->deal->id))
                ->line(langmail('deals.commented.footer'));
        }
    }
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content(
                    langmail(
                        'deals.commented.body',
                        [
                            'title'   => $this->deal->title,
                            'contact' => optional($this->deal->contact)->name,
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
                'subject'  => langmail('deals.commented.subject'),
                'icon'     => 'comments',
                'activity' => langmail(
                    'deals.commented.body',
                    [
                        'title'   => $this->deal->title,
                        'contact' => optional($this->deal->contact)->name,
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
                    'deals.commented.body',
                    [
                        'title'   => $this->deal->title,
                        'contact' => optional($this->deal->contact)->name,
                    ]
                ));
        }
    }
}
