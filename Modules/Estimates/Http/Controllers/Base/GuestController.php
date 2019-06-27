<?php

namespace Modules\Estimates\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Estimates\Entities\Estimate;

class GuestController extends Controller
{
    protected $estimate;
    protected $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->estimate = new Estimate;
        $this->request  = $request;
    }

    public function guest(Estimate $estimate)
    {
        if (isset($estimate->id)) {
            $data['page']     = langapp('estimates');
            $data['estimate'] = $estimate;

            return view('estimates::guest')->with($data);
        }
    }
    public function accept(Estimate $estimate)
    {
        if (!$estimate->isLocked()) {
            event(new \Modules\Estimates\Events\EstimateAccepted($estimate, \Auth::id()));

            toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

            return redirect(\URL::signedRoute('estimates.guest', $estimate->id));
        }
    }

    public function decline(Estimate $estimate)
    {
        if (!$estimate->isLocked()) {
            $data['estimate'] = $estimate;

            return view('estimates::modal.guestdecline')->with($data);
        }
    }

    public function cancel(Estimate $estimate)
    {
        $estimate->update($this->request->except(['token']));
        event(new \Modules\Estimates\Events\EstimateDeclined($estimate, \Auth::id()));
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = \URL::signedRoute('estimates.guest', $estimate->id);

        return ajaxResponse($data);
    }
    public function pdf(Estimate $estimate)
    {
        if (isset($estimate->id)) {
            return $estimate->pdf();
        }
        abort(404);
    }
}
