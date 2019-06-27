<?php

namespace Modules\Creditnotes\Listeners;

class CreditNoteEventSubscriber
{
    protected $user;
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
     * Credit note created listener
     */
    public function onCreditNoteCreated($event)
    {
        $data = [
            'action' => 'activity_create_creditnote', 'icon'       => 'fa-plus-circle', 'user_id' => $this->user,
            'value1' => $event->creditnote->reference_no, 'value2' => $event->creditnote->company->name,
            'url'    => $event->creditnote->url,
        ];
        $event->creditnote->activities()->create($data);
    }

    /**
     * Credit note updated listener
     */
    public function onCreditNoteUpdated($event)
    {
        $data = [
            'action' => 'activity_update_creditnote', 'icon'       => 'fa-pencil-alt', 'user_id' => $this->user,
            'value1' => $event->creditnote->reference_no, 'value2' => $event->creditnote->company->name,
            'url'    => $event->creditnote->url,
        ];
        $event->creditnote->activities()->create($data);
    }

    /**
     * Credit note deleted listener
     */
    public function onCreditNoteDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_creditnote', 'icon'       => 'fa-trash-alt', 'user_id' => $this->user,
            'value1' => $event->creditnote->reference_no, 'value2' => formatCurrency($event->creditnote->currency, $event->creditnote->balance),
            'url'    => $event->creditnote->url,
        ];
        $event->creditnote->activities()->create($data);
    }

    /**
     * Credit note sent listener
     */
    public function onCreditNoteSent($event)
    {
        $event->credit->unsetEventDispatcher();
        $data = [
            'action' => 'activity_sent_creditnote', 'icon'                                         => 'fa-envelope-open', 'user_id' => $event->user,
            'value1' => formatCurrency($event->credit->currency, $event->credit->amount), 'value2' => $event->credit->company->name,
            'url'    => $event->credit->url,
        ];
        $event->credit->activities()->create($data);
        $event->credit->update(['sent_at' => now()->toDateTimeString()]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Creditnotes\Events\CreditNoteCreated',
            'Modules\Creditnotes\Listeners\CreditNoteEventSubscriber@onCreditNoteCreated'
        );

        $events->listen(
            'Modules\Creditnotes\Events\CreditNoteUpdated',
            'Modules\Creditnotes\Listeners\CreditNoteEventSubscriber@onCreditNoteUpdated'
        );
        $events->listen(
            'Modules\Creditnotes\Events\CreditNoteDeleted',
            'Modules\Creditnotes\Listeners\CreditNoteEventSubscriber@onCreditNoteDeleted'
        );
        $events->listen(
            'Modules\Creditnotes\Events\CreditNoteSent',
            'Modules\Creditnotes\Listeners\CreditNoteEventSubscriber@onCreditNoteSent'
        );
    }
}
