<?php

namespace Modules\Leads\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Leads\Entities\Lead;

class LeadConsentController extends Controller
{
    /**
     * Lead model
     *
     * @var \Modules\Leads\Entities\Lead
     */
    protected $lead;
   
    public function __construct()
    {
        $this->lead = new Lead;
    }

    public function accept($token = null)
    {
        $lead =$this->lead->whereToken($token)->first();
        if (isset($lead->id)) {
            $lead->update(['unsubscribed_at' => null]);
            $data['page'] = $this->getPage();
            $data['lead'] = $lead;
            return view('leads::accepted')->with($data);
        }
        abort(404);
    }
    public function decline($token = null)
    {
        $lead =$this->lead->whereToken($token)->first();
        if (isset($lead->id)) {
            $lead->update(['unsubscribed_at' => now()->toDateTimeString()]);
            $data['page'] = $this->getPage();
            $data['lead'] = $lead;
            return view('leads::declined')->with($data);
        }
        abort(404);
    }

    private function getPage()
    {
        return langapp('leads');
    }
}
