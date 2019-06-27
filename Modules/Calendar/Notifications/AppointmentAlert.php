<?php

namespace Modules\Calendar\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Calendar\Entities\Appointment;

class AppointmentAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $appointment;
    public $time;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->time        = Carbon::parse($this->appointment->start_time, $this->appointment->timezone)->toDayDateTimeString();
        $this->type        = 'appointment_alert';
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
                ->greeting(langmail('appointments.alert.greeting', ['name' => $notifiable->name]))
                ->line(
                    langmail(
                        'appointments.alert.body',
                        [
                            'name'  => $this->appointment->name,
                            'time'  => $this->time,
                            'venue' => $this->appointment->venue,
                        ]
                    )
                )
                ->action('View Appointment', route('calendar.appointment.public', ['token' => $this->appointment->token]));
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
                        'appointments.alert.body',
                        [
                            'name'  => $this->appointment->name,
                            'time'  => $this->time,
                            'venue' => $this->appointment->venue,
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
                'subject'  => langmail('appointments.alert.subject'),
                'icon'     => 'handshake',
                'activity' => langmail(
                    'appointments.alert.body',
                    [
                        'name'  => $this->appointment->name,
                        'time'  => $this->time,
                        'venue' => $this->appointment->venue,
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
        return (new NexmoMessage)
            ->content(langmail(
                'appointments.alert.body',
                [
                    'name'  => $this->appointment->name,
                    'time'  => $this->time,
                    'venue' => $this->appointment->venue,
                ]
            ));
    }
}
