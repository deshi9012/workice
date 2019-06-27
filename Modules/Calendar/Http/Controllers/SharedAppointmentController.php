<?php

namespace Modules\Calendar\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Calendar\Entities\Appointment;

class SharedAppointmentController extends Controller
{

    /**
     * Show the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show($token = null)
    {
        $appointment = Appointment::where('token', $token)->first();
        if (!isset($appointment->id)) {
            abort(404);
        }
        $data['appointment'] = $appointment;
        return view('calendar::appointment')->with($data);
    }
}
