<?php

namespace Modules\Messages\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Messages\Entities\Emailing;

class EmailOpenedAlert extends Notification implements ShouldQueue
{
    use Queueable;
    public $mail;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Emailing $mail)
    {
        $this->mail = $mail;
        $this->type = 'email_opened_alert';
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
                ->greeting(langmail('emails.opened.greeting', ['name' => $notifiable->name]))
                ->line(
                    langmail(
                        'emails.opened.body',
                        [
                            'subject' => $this->mail->subject,
                            'user'    => $this->mail->emailable->name,
                        ]
                    )
                );
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
            return (new SlackMessage)
                ->content(
                    langmail(
                        'emails.opened.body',
                        [
                            'subject' => $this->mail->subject,
                            'user'    => $this->mail->emailable->name,
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
                'subject'  => langmail('emails.opened.subject'),
                'icon'     => 'envelope-open',
                'activity' => langmail(
                    'emails.opened.body',
                    [
                        'subject' => $this->mail->subject,
                        'user'    => $this->mail->emailable->name,
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
                    'emails.opened.body',
                    [
                        'subject' => $this->mail->subject,
                        'user'    => $this->mail->emailable->name,
                    ]
                ));
        }
    }
}
