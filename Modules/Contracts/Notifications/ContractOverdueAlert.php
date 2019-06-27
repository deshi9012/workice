<?php

namespace Modules\Contracts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Contracts\Entities\Contract;

class ContractOverdueAlert extends Notification
{
    use Queueable;

    public $contract;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
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
            ->greeting(langmail('contracts.expiring.greeting', ['name' => $notifiable->name]))
            ->subject(langmail('contracts.expiring.subject'))
            ->line(
                langmail(
                    'contracts.expiring.body',
                    [
                            'title' => $this->contract->contract_title,
                            'date' => dateTimeFormatted($this->contract->expiry_date),
                            'days' => now()->diffInDays($this->contract->expiry_date)
                            ]
                )
            )
            ->action('Review Contract', \URL::signedRoute('contracts.guest.show', $this->contract->id));
    }

    /*
        Send slack notification
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content(
                langmail(
                    'contracts.expiring.body',
                    [
                            'title' => $this->contract->contract_title,
                            'date' => dateTimeFormatted($this->contract->expiry_date),
                            'days' => now()->diffInDays($this->contract->expiry_date)
                        ]
                )
            );
    }
}
