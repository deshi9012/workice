<?php

namespace Modules\Calendar\Observers;

use Modules\Calendar\Entities\Appointment;

class AppointmentObserver
{

    /**
     * Listen to the appointment saving event.
     *
     * @param Appointment $appointment
     */
    public function creating(Appointment $appointment)
    {
        $appointment->token = genToken();
        $appointment->user_id = \Auth::id();
    }
}
