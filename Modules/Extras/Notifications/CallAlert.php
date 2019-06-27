<?php

namespace Modules\Extras\Notifications;

use App\Entities\Phone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class CallAlert extends Notification implements ShouldQueue
{
    use Queueable, InteractsWithQueue;

    public $call;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Phone $call)
    {
        $this->call = $call;
        $this->type = 'call_alert';
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
    /*
    Send slack notification
     */
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content(
                    langmail(
                        'calls.alert.body',
                        [
                            'subject' => $this->call->subject,
                        ]
                    )
                );
        }
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
                ->greeting(langmail('calls.alert.greeting', ['name' => $notifiable->name]))
                ->line(
                    langmail(
                        'calls.alert.body',
                        [
                            'subject' => $this->call->subject,
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
                'subject'  => langmail('calls.alert.subject'),
                'icon'     => 'phone',
                'activity' => langmail('calls.alert.body', ['subject' => $this->call->subject]),
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
                ->content(langmail('calls.alert.body', ['subject' => $this->call->subject]));
        }
    }
}
