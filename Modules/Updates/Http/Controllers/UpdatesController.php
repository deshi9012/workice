<?php

namespace Modules\Updates\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Updates\Jobs\UpdateSystemJob;

class UpdatesController extends Controller
{
    public function schedule()
    {
        $data['current_timezone'] = get_option('timezone');
        return view('updates::modal.schedule_update')->with($data);
    }

    public function backup()
    {
        \Artisan::queue('backup:run')->onQueue('high');
        return ajaxResponse(
            [
                'message'  => 'Backup process inialized. We will email you when completed',
                'redirect' => url()->previous(),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function check()
    {
        \Artisan::queue('app:updates')->onQueue('high');
        return ajaxResponse(
            [
                'message'  => 'You will receive an email when an update is available',
                'redirect' => url()->previous(),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function scheduleUpdate(Request $request)
    {
        $request->validate(
            [
                'start_time' => 'required',
                'timezone'   => 'required',
            ]
        );
        date_default_timezone_set($request->timezone);
        $request->validate(['start_time' => 'after:now']);
        $time = dateParser($request->start_time, $request->timezone);
        UpdateSystemJob::dispatch(Auth::id())->onQueue('high')->delay($time);
        toastr()->info('An email will be sent to ' . Auth::user()->email . ' when completed', langapp('response_status'));
        return ajaxResponse(
            [
                'message'  => 'Update scheduled successfully',
                'redirect' => url()->previous(),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
