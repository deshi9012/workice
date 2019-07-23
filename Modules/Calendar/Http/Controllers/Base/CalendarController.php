<?php

namespace Modules\Calendar\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Calendar\Entities\Appointment;
use Modules\Calendar\Entities\Calendar;

abstract class CalendarController extends Controller {
    /**
     * The page name
     *
     * @var string
     */
    protected $page;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request) {
        $this->middleware([
            'auth',
            'verified',
            '2fa',
            'can:menu_calendar'
        ]);
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $data['page'] = $this->getPage();

        return view('calendar::index')->with($data);
    }

    public function appointments() {
        $data['page'] = $this->getPage();

        return view('calendar::appointments')->with($data);
    }

    public function create($module = null, $id = null) {
        $data['page'] = $this->getPage();
        $data['module'] = $module;
        $data['module_id'] = $id;

        return view('calendar::modal.create')->with($data);
    }

    public function createAppointment() {
        return view('calendar::modal.create_appointment');
    }

    public function viewAppointment($id = null) {
        $data['appointment'] = Appointment::findOrFail($id);
        return view('calendar::modal.view_appointment')->with($data);
    }

    public function editAppointment($id = null) {
        $data['appointment'] = Appointment::findOrFail($id);
        return view('calendar::modal.edit_appointment')->with($data);
    }

    public function reminder($module = null, $id = null) {
        $data['module'] = $module;
        $data['module_id'] = $id;

        return view('calendar::modal.reminder')->with($data);
    }

    public function edit(Calendar $event) {
        $data['page'] = $this->getPage();
        $data['event'] = $event;

        return view('calendar::modal.update')->with($data);
    }

    public function todos() {
        $data['page'] = $this->getPage();

        return view('calendar::todo')->with($data);
    }

    public function ical() {
        return view('calendar::modal.subscribe');
    }

    public function download() {
        $vCalendar = new \Eluceo\iCal\Component\Calendar(url('/'));

        foreach (Calendar::where('is_private', '0')->orWhere('user_id', \Auth::id())->get() as $ev) {
            $vEvent = new \Eluceo\iCal\Component\Event();
            $vAlarm = new \Eluceo\iCal\Component\Alarm();
            $vAlarm->setAction('DISPLAY');
            $vAlarm->setTrigger('-PT' . $ev->alert . 'M'); // X Minutes before event starts
            $vAlarm->setDescription($ev->event_name);

            $vEvent->setDtStart(new \DateTime($ev->start_date))->setDtEnd(new \DateTime($ev->end_date))->setNoTime(false)->setDescription($ev->description)->setUrl(route('calendar.index'))->setSummary($ev->event_name);
            $vEvent->addComponent($vAlarm);
            $vCalendar->addComponent($vEvent);
        }

        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');
        echo $vCalendar->render();
        exit;
    }

    /**
     * Show event details.
     *
     * @param string $entity
     * @param string $module
     *
     * @return \Illuminate\View\View
     */
    public function view($entity = null, $module = null) {
        switch ($module) {
            case 'tasks':
                $data['task'] = \Modules\Tasks\Entities\Task::findOrFail($entity);
                break;
            case 'payments':
                $data['payment'] = \Modules\Payments\Entities\Payment::findOrFail($entity);
                break;
            case 'projects':
                $data['project'] = \Modules\Projects\Entities\Project::findOrFail($entity);
                break;
            case 'invoices':
                $data['invoice'] = \Modules\Invoices\Entities\Invoice::findOrFail($entity);
                break;
            case 'estimates':
                $data['estimate'] = \Modules\Estimates\Entities\Estimate::findOrFail($entity);
                break;
            case 'events':
                $data['event'] = Calendar::findOrFail($entity);
                break;
            case 'deals':
                $data['deal'] = \Modules\Deals\Entities\Deal::findOrFail($entity);
                break;
            case 'leads':
                $data['lead'] = \Modules\Leads\Entities\Lead::findOrFail($entity);
                break;
            case 'appointment':
                $data['appointment'] = \Modules\Leads\Entities\Appointment::findOrFail($entity);
                break;
        }
        $data['page'] = $this->getPage();

        return view('calendar::modal.event')->with($data);
    }

    private function getPage() {
        return langapp('calendar');
    }
}
