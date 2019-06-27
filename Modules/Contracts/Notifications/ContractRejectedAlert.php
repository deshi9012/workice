<?php

namespace Modules\Contracts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Contracts\Entities\Contract;

class ContractRejectedAlert extends Notification implements ShouldQueue
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
        $this->type     = 'contract_rejected_alert';
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
            return $notifiable->notifyOn($this->type, ['mail']);
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
                ->subject(langmail('contracts.rejected.subject'))
                ->markdown('emails.contracts.rejected', ['contract' => $this->contract]);
        }
    }

    /*
    Send slack notification
     */
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            $url = route('contracts.view', $this->contract->id);

            return (new SlackMessage())
                ->success()
                ->content(langmail('contracts.rejected.body', ['title' => $this->contract->contract_title]))
                ->attachment(
                    function ($attachment) use ($url) {
                        $attachment->title($this->contract->contract_title, $url)
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
                'subject'  => langmail('contracts.rejected.subject'),
                'icon'     => 'power-off',
                'activity' => langmail('contracts.rejected.body', ['title' => $this->contract->contract_title]),
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
                ->content(langmail('contracts.rejected.body', ['title' => $this->contract->contract_title]));
        }
    }
}
