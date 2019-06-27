<?php

namespace Modules\Deals\Listeners;

use App\Services\EventCreator;
use App\Services\EventCreatorFactory;
use Auth;
use Modules\Deals\Jobs\InvoiceDealJob;
use Modules\Deals\Notifications\DealCreatedAlert;
use Modules\Deals\Notifications\DealUpdatedAlert;
use Modules\Deals\Notifications\DealWonAlert;

class DealEventSubscriber
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
        $this->user         = Auth::check() ? Auth::id() : 1;
        $this->eventCreator = new EventCreator($eventfactory, 'deals');
    }

    /**
     * Deal created listener
     */
    public function onDealCreated($event)
    {
        $data = [
            'action' => 'activity_create_deal', 'icon' => 'fa-euro-sign', 'user_id' => $this->user,
            'value1' => $event->deal->title, 'value2'  => $event->deal->company->name,
            'url'    => $event->deal->url,
        ];
        $event->deal->activities()->create($data);
        $this->eventCreator->logEvent($event->deal);
        if (!\App::runningUnitTests()) {
            $event->deal->user->notify(new DealCreatedAlert($event->deal));
        }
    }

    /**
     * Deal updated listener
     */
    public function onDealUpdated($event)
    {
        $data = [
            'action' => 'activity_update_deal', 'icon' => 'fa-pencil-alt', 'user_id' => $this->user,
            'value1' => $event->deal->title, 'value2'  => $event->deal->company->name,
            'url'    => $event->deal->url,
        ];
        $event->deal->activities()->create($data);
        $this->eventCreator->logEvent($event->deal);
        if (!\App::runningUnitTests()) {
            $event->deal->user->notify(new DealUpdatedAlert($event->deal));
        }
    }

    /**
     * Deal deleted listener
     */
    public function onDealDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_deal', 'icon' => 'fa-trash-alt', 'user_id' => $this->user,
            'value1' => $event->deal->title, 'value2'  => $event->deal->company->name,
            'url'    => $event->deal->url,
        ];
        $event->deal->activities()->create($data);
        $this->eventCreator->deleteEvent($event->deal);
    }
    /**
     * Deal won listener
     */
    public function onDealWon($event)
    {
        $event->deal->update(
            [
                'status'        => 'won',
                'won_time'      => now()->toDateTimeString(),
                'days_to_close' => $event->deal->created_at->diffInDays(now()),
                'archived_at'   => now()->toDateTimeString(),
            ]
        );
        $event->deal->notes()->create(
            [
                'description' => 'Deal has been Won by **' . $event->deal->user->name . '** 🎉🎉',
                'user_id'     => $event->deal->user_id,
            ]
        );
        if (settingEnabled('deals_invoice_won')) {
            InvoiceDealJob::dispatch($event->deal)->onQueue('normal');
        }
        $event->deal->user->notify(new DealWonAlert($event->deal));
    }
    /**
     * Deal lost listener
     */
    public function onDealLost($event)
    {
        $event->deal->update(
            [
                'status'        => 'lost',
                'lost_time'     => now()->toDateTimeString(),
                'lost_reason'   => request('lost_reason'),
                'days_to_close' => $event->deal->created_at->diffInDays(now()),
                'archived_at'   => now()->toDateTimeString(),
            ]
        );
        $event->deal->notes()->create(
            [
                'description' => 'Deal has been marked as lost by **' . $event->deal->user->name . '** 😞',
                'user_id'     => $event->deal->user_id,
            ]
        );
        $event->deal->user->notify(new \Modules\Deals\Notifications\DealLostAlert($event->deal));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Deals\Events\DealCreated',
            'Modules\Deals\Listeners\DealEventSubscriber@onDealCreated'
        );

        $events->listen(
            'Modules\Deals\Events\DealUpdated',
            'Modules\Deals\Listeners\DealEventSubscriber@onDealUpdated'
        );
        $events->listen(
            'Modules\Deals\Events\DealDeleted',
            'Modules\Deals\Listeners\DealEventSubscriber@onDealDeleted'
        );
        $events->listen(
            'Modules\Deals\Events\DealWon',
            'Modules\Deals\Listeners\DealEventSubscriber@onDealWon'
        );
        $events->listen(
            'Modules\Deals\Events\DealLost',
            'Modules\Deals\Listeners\DealEventSubscriber@onDealLost'
        );
    }
}
