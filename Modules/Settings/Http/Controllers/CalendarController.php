<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Calendar\Entities\CalendarType;

class CalendarController extends Controller
{
    public $cal;
    public $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(CalendarType $cal, Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
        $this->cal     = $cal;
    }

    public function index()
    {
        $data['calendars'] = $this->cal->orderBy('id', 'asc')->get();

        return view('settings::modal.calendars')->with($data);
    }

    public function save()
    {
        if ($this->request->ajax()) {
            $this->request->validate(['name' => 'required']);
            if ($calendar = $this->cal->create($this->request->all())) {
                $html = view('settings::_ajax.new_calendar_html', compact('calendar'))->render();

                return response()->json(
                    [
                        'status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')],
                    200
                );
            }
        }
    }

    public function edit($id = null)
    {
        $data['calendar'] = $this->cal->findOrFail($id);

        return view('settings::modal.update_calendar')->with($data);
    }

    public function update($id = null)
    {
        $calendar = $this->cal->findOrFail($id);
        $calendar->update($this->request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function delete()
    {
        $id = $this->request->id;
        $calendar = $this->cal->findOrFail($id);
        if ($this->request->ajax()) {
            if ($calendar->delete()) {
                return response()->json(
                    [
                        'status' => 'success', 'message' => langapp('deleted_successfully')],
                    200
                );
            }

            return response()->json(['status' => 'errors', 'message' => 'Something went wrong'], 401);
        }
    }
}
