<?php
namespace Modules\Estimates\Listeners;

use App\Services\EventCreatorFactory;
use Modules\Estimates\Notifications\EstimateDeclinedAlert;
use Modules\Users\Entities\User;

class EstimateEventSubscriber
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
        $this->user         = \Auth::check() ? \Auth::id() : 1;
        $this->eventCreator = new \App\Services\EventCreator($eventfactory, 'estimates');
    }

    /**
     * Estimate created listener
     */
    public function onEstimateCreated($event)
    {
        $data = [
            'action' => 'activity_create_estimate', 'icon'       => 'fa-plus-square', 'user_id' => $this->user,
            'value1' => $event->estimate->reference_no, 'value2' => $event->estimate->company->name,
            'url'    => $event->estimate->url,
        ];
        $event->estimate->activities()->create($data);
        $this->eventCreator->logEvent($event->estimate);
    }

    /**
     * Estimate updated listener
     */
    public function onEstimateUpdated($event)
    {
        $data = [
            'action' => 'activity_update_estimate', 'icon'       => 'fa-pencil-alt', 'user_id' => $this->user,
            'value1' => $event->estimate->reference_no, 'value2' => $event->estimate->company->name,
            'url'    => $event->estimate->url,
        ];
        $event->estimate->activities()->create($data);
        $this->eventCreator->logEvent($event->estimate);
    }

    /**
     * Estimate accepted listener
     */
    public function onEstimateAccepted($event)
    {
        if (settingEnabled('estimate_to_project')) {
            $event->estimate->toProject();
        }
        if (settingEnabled('estimate_to_invoice')) {
            $event->estimate->toInvoice();
        }
        if ($event->estimate->deal_id > 0) {
            event(new \Modules\Deals\Events\DealWon($event->estimate->deal));
        }
        $event->estimate->update(
            [
                'status' => 'Accepted', 'accepted_time' => now()->toDateTimeString(),
            ]
        );
        $data = [
            'action' => 'activity_accepted_estimate', 'icon' => 'fa-check-circle', 'user_id' => $this->user,
            'value1' => $event->estimate->name, 'value2'     => formatCurrency($event->estimate->currency, $event->estimate->amount()),
            'url'    => $event->estimate->url,
        ];
        $event->estimate->activities()->create($data);
        $user = \Modules\Users\Entities\User::role('admin')->first();
        $user->notify(new \Modules\Estimates\Notifications\EstimateAcceptedAlert($event->estimate));
    }
    /**
     * Estimate declined listener
     */
    public function onEstimateDeclined($event)
    {
        if ($event->estimate->deal_id > 0) {
            event(new \Modules\Deals\Events\DealLost($event->estimate->deal));
        }
        $event->estimate->update(
            [
                'status'          => 'Declined', 'rejected_time' => now()->toDateTimeString(),
                'rejected_reason' => request('rejected_reason'),
            ]
        );
        $data = [
            'action' => 'activity_declined_estimate', 'icon' => 'fa-times-circle', 'user_id' => $this->user,
            'value1' => $event->estimate->name, 'value2'     => formatCurrency($event->estimate->currency, $event->estimate->amount()),
            'url'    => $event->estimate->url,
        ];
        $event->estimate->activities()->create($data);
        $user = User::role('admin')->first();
        $user->notify(new EstimateDeclinedAlert($event->estimate));
    }

    /**
     * Estimate invoiced listener
     */
    public function onEstimateInvoiced($event)
    {
        if (settingEnabled('archive_estimate')) {
            $event->estimate->update(['archived_at' => now()->toDateTimeString()]);
        }
        $data = [
            'action' => 'activity_convert_estimate', 'icon' => 'fa-check-circle', 'user_id' => $event->user_id,
            'value1' => $event->estimate->name, 'value2'    => formatCurrency($event->estimate->currency, $event->estimate->amount),
            'url'    => $event->estimate->url,
        ];
        $event->estimate->activities()->create($data);
    }

    /**
     * Estimate sent listener
     */
    public function onEstimateSent($event)
    {
        $event->estimate->unsetEventDispatcher();
        $data = [
            'action' => 'activity_sent_estimate', 'icon'                                               => 'fa-envelope-open', 'user_id' => $event->user,
            'value1' => formatCurrency($event->estimate->currency, $event->estimate->amount), 'value2' => $event->estimate->company->name,
            'url'    => $event->estimate->url,
        ];
        $event->estimate->activities()->create($data);
        $event->estimate->update(['sent_at' => now()->toDateTimeString(), 'is_visible' => 1]);
    }
    /**
     * Estimate viewed listener
     */
    public function onEstimateViewed($event)
    {
        $event->estimate->activities()->create(
            [
                'action' => 'activity_viewed_estimate', 'icon'       => 'fa-check-circle', 'user_id' => $event->user,
                'value1' => $event->estimate->reference_no, 'value2' => '',
                'url'    => $event->estimate->url,
            ]
        );
        $event->estimate->unsetEventDispatcher();
        if (!is_null($event->estimate->sent_at)) {
            $user = \Modules\Users\Entities\User::role('admin')->first();
            $user->notify(new \Modules\Estimates\Notifications\EstimateViewedAlert($event->estimate));
            $event->estimate->update(['viewed_at' => now()->toDateTimeString()]);
        }
    }

    /**
     * Estimate deleted listener
     */
    public function onEstimateDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_estimate', 'icon'       => 'fa-trash-alt', 'user_id' => $this->user,
            'value1' => $event->estimate->reference_no, 'value2' => $event->estimate->company->name,
            'url'    => $event->estimate->url,
        ];
        $event->estimate->activities()->create($data);
        $this->eventCreator->deleteEvent($event->estimate);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Estimates\Events\EstimateCreated',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateCreated'
        );

        $events->listen(
            'Modules\Estimates\Events\EstimateUpdated',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateUpdated'
        );
        $events->listen(
            'Modules\Estimates\Events\EstimateDeleted',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateDeleted'
        );

        $events->listen(
            'Modules\Estimates\Events\EstimateSent',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateSent'
        );

        $events->listen(
            'Modules\Estimates\Events\EstimateAccepted',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateAccepted'
        );
        $events->listen(
            'Modules\Estimates\Events\EstimateDeclined',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateDeclined'
        );

        $events->listen(
            'Modules\Estimates\Events\EstimateInvoiced',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateInvoiced'
        );
        $events->listen(
            'Modules\Estimates\Events\EstimateViewed',
            'Modules\Estimates\Listeners\EstimateEventSubscriber@onEstimateViewed'
        );
    }
}
