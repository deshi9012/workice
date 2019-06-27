<?php

namespace Modules\Contracts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Contracts\Entities\Contract;

class ContractViewedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $contract;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
        $this->type     = 'contract_viewed_alert';
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
                ->line(langmail('contracts.viewed.body', ['title' => $this->contract->contract_title]))
                ->action('View Contract', route('contracts.view', $this->contract->id));
        }
    }

    /*
    Send slack notification
     */
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage())
                ->success()
                ->content(langmail('contracts.viewed.body', ['title' => $this->contract->contract_title]))
                ->attachment(
                    function ($attachment) {
                        $attachment->title($this->contract->contract_title, route('contracts.view', $this->contract->id))
                            ->fields(
                                [
                                    langapp('title')       => $this->contract->contract_title,
                                    langapp('company')     => $this->contract->company->name,
                                    langapp('expiry_date') => dateTimeFormatted($this->contract->expiry_date),
                                    langapp('viewed')      => dateElapsed($this->contract->viewed_at),
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
                'subject'  => langmail('contracts.viewed.subject'),
                'icon'     => 'check',
                'activity' => langmail('contracts.viewed.body', ['title' => $this->contract->contract_title]),
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
                ->content(langmail('contracts.viewed.body', ['title' => $this->contract->contract_title]));
        }
    }
}
