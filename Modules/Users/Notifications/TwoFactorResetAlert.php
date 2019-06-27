<?php

namespace Modules\Users\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TwoFactorResetAlert extends Notification
{
    use Queueable;
    public $secret;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hi '.$notifiable->name.',')
            ->subject(get_option('company_name').' 2FA Authentication')
            ->line('Enter this code '.$this->secret.' into your Google Authenticator App')
            ->line('Thank you for using our portal!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
