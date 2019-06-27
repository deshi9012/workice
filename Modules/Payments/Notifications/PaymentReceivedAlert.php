<?php

namespace Modules\Payments\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Payments\Entities\Payment;

class PaymentReceivedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $payment;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->type    = 'payment_received_alert';
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
            return $notifiable->notifyOn($this->type, ['slack', 'mail']);
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
                ->greeting(langmail('payments.received.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('payments.received.subject'))
                ->line(langmail('payments.received.body', ['amount' => $this->payment->amount_formatted, 'date' => dateTimeFormatted($this->payment->payment_date), 'code' => $this->payment->AsInvoice->reference_no]))
                ->action(langapp('view') . ' ' . langapp('invoice'), route('invoices.view', $this->payment->AsInvoice->id))
                ->line(langmail('payments.received.footer'));
        }
    }

    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage())
                ->success()
                ->content(
                    langmail(
                        'payments.received.body',
                        [
                            'amount' => $this->payment->amount_formatted,
                            'date'   => dateTimeFormatted($this->payment->payment_date),
                            'code'   => $this->payment->AsInvoice->reference_no,
                        ]
                    )
                )
                ->attachment(
                    function ($attachment) {
                        $attachment->title($this->payment->code, route('payments.view', $this->payment->id))
                            ->fields(
                                [
                                    langapp('company')        => $this->payment->company->name,
                                    langapp('payment_method') => $this->payment->paymentMethod->method_name,
                                    langapp('invoice')        => $this->payment->AsInvoice->reference_no,
                                    langapp('amount')         => $this->payment->amount_formatted,
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
                'subject'  => langmail('payments.received.subject'),
                'icon'     => 'money-check-alt',
                'activity' => langmail(
                    'payments.received.body',
                    [
                        'amount' => $this->payment->amount_formatted,
                        'date'   => dateTimeFormatted($this->payment->payment_date),
                        'code'   => $this->payment->AsInvoice->reference_no,
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
                    'payments.received.body',
                    [
                        'amount' => $this->payment->amount_formatted,
                        'date'   => dateTimeFormatted($this->payment->payment_date),
                        'code'   => $this->payment->AsInvoice->reference_no,
                    ]
                ));
        }
    }
}
