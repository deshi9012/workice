<?php

namespace Modules\Subscriptions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Subscriptions\Entities\SubscriptionPlan;

class PlansController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_subscriptions']);
        $this->request = $request;
    }
    public function plans()
    {
        $data['page']   = $this->getPage();
        $data['filter'] = request('filter', 'all');
        return view('subscriptions::plans')->with($data);
    }

    public function create()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $data['plans'] = \Stripe\Plan::all();
        return view('subscriptions::modal.create')->with($data);
    }

    public function edit(SubscriptionPlan $plan)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $data['plans'] = \Stripe\Plan::all();
        $data['plan']  = $plan;
        return view('subscriptions::modal.edit_plan')->with($data);
    }

    public function send(SubscriptionPlan $plan)
    {
        $data['plan'] = $plan;
        return view('subscriptions::modal.send_plan')->with($data);
    }

    public function delete(SubscriptionPlan $plan)
    {
        $data['plan'] = $plan;
        return view('subscriptions::modal.delete_plan')->with($data);
    }
    private function getPage()
    {
        return langapp('subscriptions');
    }
}
