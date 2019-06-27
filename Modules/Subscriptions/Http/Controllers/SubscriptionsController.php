<?php

namespace Modules\Subscriptions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscriptions\Entities\CustomSubscription;
use Modules\Subscriptions\Entities\SubscriptionPlan;

class SubscriptionsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_subscriptions']);
        $this->request = $request;
    }
    public function index()
    {
        $data['page']   = $this->getPage();
        $data['filter'] = request('filter', 'all');
        return view('subscriptions::index')->with($data);
    }

    public function invoices()
    {
        $data['page'] = $this->getPage();
        return view('subscriptions::invoices')->with($data);
    }

    public function subscribe(SubscriptionPlan $plan)
    {
        $data['page'] = $this->getPage();
        $data['plan'] = $plan;
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $data['subscription'] = array_first(
            \Stripe\Plan::all()->data,
            function ($item) use ($plan) {
                return $item->id == $plan->stripe_plan_id;
            }
        );
        $data['subscribed'] = \Auth::user()->profile->business->subscribed($plan->stripe_plan_id);
        return view('subscriptions::subscribe')->with($data);
    }

    public function cancel(SubscriptionPlan $plan)
    {
        $data['subscription'] = \Auth::user()->profile->business->subscriptions()->where('name', $plan->name)->first();
        return view('subscriptions::modal.cancel')->with($data);
    }

    public function activate(SubscriptionPlan $plan)
    {
        $subscription = \Auth::user()->profile->business->subscriptions()->where('name', $plan->name)->first();
        \Auth::user()->profile->business->subscription($subscription->name)->resume();
        auth()->user()->assignRole('subscriber');
        toastr()->success(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('subscriptions.index');
    }

    public function deactivate()
    {
        $this->request->validate(['id' => 'required|numeric']);
        $subscription = \Auth::user()->profile->business->subscriptions()->where('id', $this->request->id)->first();
        if ($this->request->cancel_immediately == 1) {
            \Auth::user()->profile->business->subscription($subscription->name)->cancelNow();
        } else {
            \Auth::user()->profile->business->subscription($subscription->name)->cancel();
        }
        auth()->user()->removeRole('subscriber');
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('subscriptions.index');

        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    public function adminCancel($id)
    {
        $data['subscription'] = CustomSubscription::where('id', $id)->first();
        return view('subscriptions::modal.admin_cancel')->with($data);
    }
    public function adminActivate($id)
    {
        $subscription = CustomSubscription::where('id', $id)->first();
        $subscription->owner->subscription($subscription->name)->resume();
        toastr()->success(langapp('changes_saved_successful'), langapp('response_status'));
        return redirect()->route('subscriptions.index');
    }
    public function adminDeactivate()
    {
        $this->request->validate(['id' => 'required|numeric']);
        $subscription = CustomSubscription::where('id', $this->request->id)->first();
        if ($this->request->cancel_immediately == 1) {
            $subscription->owner->subscription($subscription->name)->cancelNow();
        } else {
            $subscription->owner->subscription($subscription->name)->cancel();
        }
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('subscriptions.index');

        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    public function process()
    {
        $token       = $this->request->stripeToken;
        $billingDate = strtotime($this->request->billing_date) > time() ? dateParser($this->request->billing_date) : now()->addMinutes(5);
        \Auth::user()->profile->business->newSubscription($this->request->name, $this->request->plan)->trialUntil($billingDate)->withCoupon($this->request->coupon)->create($token);
        $role = \Role::firstOrCreate(['name' => 'subscriber']);
        auth()->user()->assignRole($role->name);
        return redirect(route('subscriptions.index'));
    }

    private function getPage()
    {
        return langapp('subscriptions');
    }
}
