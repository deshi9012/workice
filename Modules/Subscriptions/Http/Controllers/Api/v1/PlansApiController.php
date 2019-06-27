<?php

namespace Modules\Subscriptions\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscriptions\Entities\SubscriptionPlan;

class PlansApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * SubscriptionPlan Model
     *
     * @var SubscriptionPlan
     */
    protected $plan;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->plan    = new SubscriptionPlan;
    }

    public function save()
    {
        $this->request->validate(
            [
                'name'           => 'required',
                'billing_date'   => 'required|date|after:now',
                'client_id'      => 'required|numeric',
                'stripe_plan_id' => 'required',
            ]
        );
        $plan = $this->plan->create($this->request->all());
        return ajaxResponse(
            [
                'id'       => $plan->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('plans.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function update($id)
    {
        $plan = $this->plan->findOrFail($id);
        $plan->update($this->request->all());
        return ajaxResponse(
            [
                'id'       => $plan->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('plans.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function send($id)
    {
        $plan = $this->plan->findOrFail($id);
        \Mail::to($plan->owner->contact->email)->send(new \Modules\Subscriptions\Emails\SendPlanMail($plan));
        return ajaxResponse(
            [
                'id'       => $plan->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => route('plans.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function delete($id)
    {
        $plan = $this->plan->findOrFail($id);
        $plan->delete();
        return ajaxResponse(
            [
                'id'       => $plan->id,
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('plans.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
