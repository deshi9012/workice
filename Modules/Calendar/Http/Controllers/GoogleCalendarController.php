<?php

namespace Modules\Calendar\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Calendar\Entities\Calendar;
use Exception;

class GoogleCalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Import google events
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */

    public function importGoogleEvents(Request $request)
    {
        $code          = $request->code;
        $googleService = \OAuth::consumer('Google');
        if (!is_null($code)) {
            $token  = $googleService->requestAccessToken($code);
            $result = json_decode($googleService->request('https://www.googleapis.com/calendar/v3/calendars/primary/events?alt=json&max-results=400'), true);
            date_default_timezone_set($result['timeZone']);
            foreach ($result['items'] as $event) {
                $startDate           = isset($event['start']['date']) ? $event['start']['date'] : $event['start']['dateTime'];
                $data                = [];
                $data['event_name']  = $event['summary'];
                $data['description'] = isset($event['description']) ? $event['description'] : '';
                $data['start_date']  = $startDate;
                $data['end_date']    = isset($event['end']['date']) ? $event['end']['date'] : $event['end']['dateTime'];
                $data['user_id']     = \Auth::id();
                $data['color']       = '#37b8c9';
                $data['location']    = isset($event['location']) ? $event['location'] : '';
                $data['alert']       = 30;
                $data['project']     = 0;
                $data['module']      = 'events';
                $data['created']     = now();
                Calendar::updateOrCreate(
                    [
                        'event_name' => $event['summary'],
                        'start_date' => dbDate($startDate),
                    ],
                    $data
                );
            }
            toastr()->info(count($result['items']) . ' Events processed from Google', langapp('response_status'));

            return redirect()->route('calendar.index');
        } else {
            $url = $googleService->getAuthorizationUri();

            return redirect((string) $url);
        }
    }

    public function deleteCalendarEvent($event_id, $calendar_id, $access_token)
    {
        $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/' . $event_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_events);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token, 'Content-Type: application/json'));
        $data      = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 204) {
            throw new Exception('Error : Failed to delete event');
        }
    }
}
