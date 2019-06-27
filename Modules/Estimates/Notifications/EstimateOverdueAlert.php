<?php

namespace Modules\Estimates\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Estimates\Entities\Estimate;

class EstimateOverdueAlert extends Notification implements ShouldQueue
{
    use Queueable;
    public $estimate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Estimate $estimate)
    {
        $this->estimate = $estimate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack', 'mail'];
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
            ->greeting(langmail('estimates.expiring.greeting', ['name' => $notifiable->name]))
            ->subject(langmail('estimates.expiring.subject'))
            ->line(
                langmail(
                    'estimates.expiring.body',
                    [
                        'code' => $this->estimate->reference_no,
                        'date' => dateTimeFormatted($this->estimate->due_date),
                        'days' => now()->diffInDays($this->estimate->due_date),
                    ]
                )
            )
            ->action('Review Estimate', \URL::signedRoute('estimates.guest', $this->estimate->id));
    }

    /*
    Send slack notification
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content(
                langmail(
                    'estimates.expiring.body',
                    [
                        'code' => $this->estimate->reference_no,
                        'date' => dateTimeFormatted($this->estimate->due_date),
                        'days' => now()->diffInDays($this->estimate->due_date),
                    ]
                )
            );
    }
}
