<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebLeadRequest;
use Illuminate\Http\Request;
use Modules\Leads\Entities\Lead;

class WebToLeadController extends Controller
{
    public $lead;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lead = new Lead;
    }

    public function form()
    {
        return view('leads::weblead');
    }

    public function capture(WebLeadRequest $request)
    {
        $rules                    = [];
        if (settingEnabled('lead_recaptcha')) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }
        $this->validate($request, $rules);

        $this->lead->firstOrCreate(['email' => $request->email], $request->except(['agree_terms']));

        toastr()->success(langapp('lead_contact_success'), langapp('response_status'));
        return redirect(url()->previous())->with('message', langapp('lead_contact_success'));
    }
}
