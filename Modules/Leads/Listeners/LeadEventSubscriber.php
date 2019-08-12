<?php

namespace Modules\Leads\Listeners;

use App\Services\EventCreatorFactory;
use Modules\Leads\Emails\RequestConsent;
use Modules\Leads\Notifications\LeadAssignedAlert;
use Modules\Leads\Notifications\LeadConvertedAlert;

class LeadEventSubscriber
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
        $this->eventCreator = new \App\Services\EventCreator($eventfactory, 'leads');
    }

    /**
     * Lead created listener
     */
    public function onLeadCreated($event)
    {
        $data = [
            'action' => 'activity_create_lead', 'icon' => 'fa-user-circle-o', 'user_id' => $this->user,
            'value1' => $event->lead->name, 'value2'   => $event->lead->AsSource->name,
            'url'    => $event->lead->url,
        ];
        $event->lead->activities()->create($data);
        $this->eventCreator->logEvent($event->lead);
        if (settingEnabled('leads_opt_in')) {
            \Mail::to($event->lead)->send(new RequestConsent($event->lead));
        }
        if (!\App::runningUnitTests() && session('lock_assigned_alert') == false) {
            $event->lead->agent->notify(new LeadAssignedAlert($event->lead));
        }
    }

    /**
     * Lead has been converted to customer
     */
    public function onLeadConverted($event)
    {
        $event->lead->update(['converted_at' => now()->toDateTimeString(), 'archived_at' => now()->toDateTimeString()]);
        $data = [
            'action' => 'activity_convert_lead', 'icon' => 'fa-balance-scale', 'user_id' => $event->user,
            'value1' => $event->lead->name, 'value2'    => '',
            'url'    => $event->lead->url,
        ];
        $event->lead->activities()->create($data);
        $event->lead->agent->notify(new LeadConvertedAlert($event->lead));
        if (settingEnabled('leads_delete_converted')) {
            $event->lead->delete();
        }
    }

    /**
     * Lead emailed listener
     */
    public function onLeadEmailed($event)
    {
        $data = [
            'action' => 'activity_email_lead', 'icon' => 'fa-envelope-o', 'user_id' => $this->user,
            'value1' => $event->lead->name, 'value2'  => $event->mail->lead->email,
            'url'    => $event->lead->url,
        ];
        $event->lead->activities()->create($data);
        $event->lead->unsetEventDispatcher();
        $event->lead->update(['next_folowup' => now()->addDays(get_option('lead_followup_days'))]);
    }

    /**
     * Lead updated listener
     */
    public function onLeadUpdated($event)
    {
        $data = [
            'action' => 'activity_update_lead', 'icon' => 'fa-pencil-alt', 'user_id' => $this->user,
            'value1' => $event->lead->name, 'value2'   => '',
            'url'    => $event->lead->url,
        ];
        $event->lead->activities()->create($data);
        $this->eventCreator->logEvent($event->lead);
    }

    /**
     * Lead deleted listener
     */
    public function onLeadDeleted($event)
    {
        $data = [
            'action' => 'activity_delete_lead', 'icon' => 'fa-trash', 'user_id' => $this->user,
            'value1' => $event->lead->name, 'value2'   => $event->lead->AsSource->name,
            'url'    => $event->lead->url,
        ];
        $event->lead->activities()->create($data);
        $this->eventCreator->deleteEvent($event->lead);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Leads\Events\LeadCreated',
            'Modules\Leads\Listeners\LeadEventSubscriber@onLeadCreated'
        );

        $events->listen(
            'Modules\Leads\Events\LeadUpdated',
            'Modules\Leads\Listeners\LeadEventSubscriber@onLeadUpdated'
        );
        $events->listen(
            'Modules\Leads\Events\LeadConverted',
            'Modules\Leads\Listeners\LeadEventSubscriber@onLeadConverted'
        );
        $events->listen(
            'Modules\Leads\Events\LeadEmailed',
            'Modules\Leads\Listeners\LeadEventSubscriber@onLeadEmailed'
        );
        $events->listen(
            'Modules\Leads\Events\LeadDeleted',
            'Modules\Leads\Listeners\LeadEventSubscriber@onLeadDeleted'
        );
    }
}
