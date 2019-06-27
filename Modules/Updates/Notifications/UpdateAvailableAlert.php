<?php

namespace Modules\Updates\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UpdateAvailableAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $update;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($update)
    {
        $this->update = $update;
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
            ->greeting('Hey '.$notifiable->name.',')
            ->subject('Update Available')
            ->line('There is an update v'.$this->update->attributes->version.' available for Workice CRM released on '.$this->update->attributes->date)
            ->action('Schedule Update', url('/settings/info'))
            ->line('Thank you for using Workice CRM!');
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
