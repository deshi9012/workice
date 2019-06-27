<?php

namespace Modules\Payments\Listeners;

use App\Services\EventCreatorFactory;
use Modules\Payments\Notifications\PaymentReceivedAlert;
use Modules\Payments\Notifications\ThankYouAlert;
use Modules\Users\Entities\User;

class PaymentEventSubscriber
{
    protected $user;
    protected $eventCreator;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EventCreatorFactory $eventfactory)
    {
        $this->user         = \Auth::id() ?? 1;
        $this->eventCreator = new \App\Services\EventCreator($eventfactory, 'payments');
    }

    /**
     * Payment received listener
     */
    public function onPaymentReceived($event)
    {
        $data = [
            'action' => 'activity_payment_of', 'icon'               => 'fa-usd', 'user_id' => $event->user,
            'value1' => $event->payment->amount_formatted, 'value2' => $event->payment->AsInvoice->reference_no,
            'url'    => $event->payment->url,
        ];
        $event->payment->activities()->create($data);
        $this->eventCreator->logEvent($event->payment);
        if ($event->payment->send_email == 1) {
            if ($event->payment->company->primary_contact > 0) {
                $event->payment->company->contact->notify(new ThankYouAlert($event->payment));
            }
        }
        $admin = User::role('admin')->first();
        $admin->notify(new PaymentReceivedAlert($event->payment));
    }

    /**
     * Payment updated listener
     */
    public function onPaymentUpdated($event)
    {
        $data = [
            'action' => 'activity_update_payment', 'icon'           => 'fa-pencil', 'user_id' => $this->user,
            'value1' => $event->payment->amount_formatted, 'value2' => $event->payment->code,
            'url'    => $event->payment->url,
        ];
        $event->payment->activities()->create($data);
        $this->eventCreator->logEvent($event->payment);
    }

    /**
     * Payment deleted listener
     */
    public function onPaymentDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_payment', 'icon'           => 'fa-trash', 'user_id' => $this->user,
            'value1' => $event->payment->amount_formatted, 'value2' => $event->payment->code,
            'url'    => $event->payment->url,
        ];
        $event->payment->activities()->create($data);
        $this->eventCreator->deleteEvent($event->payment);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Payments\Events\PaymentReceived',
            'Modules\Payments\Listeners\PaymentEventSubscriber@onPaymentReceived'
        );

        $events->listen(
            'Modules\Payments\Events\PaymentUpdated',
            'Modules\Payments\Listeners\PaymentEventSubscriber@onPaymentUpdated'
        );
        $events->listen(
            'Modules\Payments\Events\PaymentDeleted',
            'Modules\Payments\Listeners\PaymentEventSubscriber@onPaymentDeleted'
        );
    }
}
