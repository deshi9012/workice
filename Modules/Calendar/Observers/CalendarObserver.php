<?php

namespace Modules\Calendar\Observers;

use Modules\Calendar\Entities\Calendar;

class CalendarObserver
{

    /**
     * Listen to the calendar saving event.
     *
     * @param Calendar $event
     */
    public function created(Calendar $event)
    {
        if ($event->eventable_id == 0) {
            $event->url = 'calendar/view/'.$event->id.'/events';
            $event->save();
        }
    }
}
