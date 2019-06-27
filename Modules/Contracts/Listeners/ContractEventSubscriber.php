<?php

namespace Modules\Contracts\Listeners;

use Modules\Contracts\Notifications\ContractRejectedAlert;
use Modules\Contracts\Notifications\ContractSignedAlert;
use Modules\Contracts\Notifications\ContractViewedAlert;

class ContractEventSubscriber
{
    public $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = \Auth::id() ?? 1;
    }

    /**
     * Handle payment received
     */
    public function onContractCreated($event)
    {
        $event->contract->activities()->create(
            [
                'action' => 'activity_create_contract', 'icon'         => 'fa-plus-circle', 'user_id' => $this->user,
                'value1' => $event->contract->contract_title, 'value2' => $event->contract->company->name,
                'url'    => $event->contract->url,
            ]
        );
    }

    /**
     * Contract sent
     */
    public function onContractSent($event)
    {
        $event->contract->update(['is_visible' => 1, 'sent_at' => now()->toDateTimeString()]);
        $event->contract->activities()->create(
            [
                'action' => 'activity_sent_contract', 'icon'           => 'fa-envelope-open', 'user_id' => $this->user,
                'value1' => $event->contract->contract_title, 'value2' => optional($event->contract->company->contact)->email,
                'url'    => $event->contract->url,
            ]
        );
    }

    /**
     * Handle payment updated
     */
    public function onContractUpdated($event)
    {
        $event->contract->activities()->create(
            [
                'action' => 'activity_update_contract', 'icon'         => 'fa-pencil-alt', 'user_id' => $this->user,
                'value1' => $event->contract->contract_title, 'value2' => $event->contract->company->name,
                'url'    => $event->contract->url,
            ]
        );
    }

    /**
     * Contract sent
     */
    public function onContractViewed($event)
    {
        $event->contract->activities()->create(
            [
                'action' => 'activity_viewed_contract', 'icon'         => 'fa-check-circle', 'user_id' => $this->user,
                'value1' => $event->contract->contract_title, 'value2' => '',
                'url'    => $event->contract->url,
            ]
        );
        if (!is_null($event->contract->sent_at) && is_null($event->contract->viewed_at)) {
            $event->contract->user->notify(new ContractViewedAlert($event->contract));
            $event->contract->update(['viewed_at' => now()->toDateTimeString()]);
        }
    }
    public function onContractSigned($event)
    {
        $event->contract->update(['signed' => 1]);
        if (settingEnabled('contract_to_project')) {
            $event->contract->createProjectFromContract();
        }
        $event->contract->user->notify(new ContractSignedAlert($event->contract));
    }
    public function onContractRejected($event)
    {
        $event->contract->activities()->create(
            [
                'action' => 'activity_rejected_contract', 'icon'       => 'fa-times-circle', 'user_id' => $this->user,
                'value1' => $event->contract->contract_title, 'value2' => $event->contract->company->name,
                'url'    => $event->contract->url,
            ]
        );
        $event->contract->update(
            [
                'rejected_at'     => now()->toDateTimeString(),
                'rejected_reason' => $event->message,
            ]
        );
        $event->contract->user->notify(new ContractRejectedAlert($event->contract));
    }

    /**
     * Handle payment deleted
     */
    public function onContractDeleted($event)
    {
        $event->contract->activities()->create(
            [
                'action' => 'activity_delete_contract', 'icon'         => 'fa-trash', 'user_id' => $this->user,
                'value1' => $event->contract->contract_title, 'value2' => '',
                'url'    => $event->contract->url,
            ]
        );
    }

    public function onClauseUpdated($event)
    {
        $event->clause->activities()->create(
            [
                'action' => 'activity_update_clause', 'icon' => 'fa-pencil-alt', 'user_id' => $this->user,
                'value1' => $event->clause->name, 'value2'   => '',
                'url'    => $event->contract->url,
            ]
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Contracts\Events\ContractCreated',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onContractCreated'
        );

        $events->listen(
            'Modules\Contracts\Events\ContractSent',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onContractSent'
        );
        $events->listen(
            'Modules\Contracts\Events\ContractViewed',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onContractViewed'
        );
        $events->listen(
            'Modules\Contracts\Events\ContractSigned',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onContractSigned'
        );
        $events->listen(
            'Modules\Contracts\Events\ContractRejected',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onContractRejected'
        );

        $events->listen(
            'Modules\Contracts\Events\ContractUpdated',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onContractUpdated'
        );
        $events->listen(
            'Modules\Contracts\Events\ContractDeleted',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onContractDeleted'
        );
        $events->listen(
            'Modules\Contracts\Events\ClauseUpdated',
            'Modules\Contracts\Listeners\ContractEventSubscriber@onClauseUpdated'
        );
    }
}
