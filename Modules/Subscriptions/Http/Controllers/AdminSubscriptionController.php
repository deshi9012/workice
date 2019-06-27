<?php

namespace Modules\Subscriptions\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscriptions\Entities\CustomSubscription;
use Modules\Subscriptions\Entities\SubscriptionPlan;

class AdminSubscriptionController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_subscriptions']);
        $this->request = $request;
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with(['owner:id,name,currency'])->orderBy('id', 'desc');
        return DataTables::eloquent($model)
            ->editColumn('name', function ($subscription) {
                return '<strong>' . $subscription->name . '</strong>';
            })
            ->editColumn('client_id', function ($subscription) {
                return optional($subscription->owner)->id > 0 ? '<a href="' . route('clients.view', $subscription->owner->id) . '">' . str_limit($subscription->owner->name, 15) . '</a>' : 'N/A';
            })
            ->editColumn('plan', function ($subscription) {
                return '<span class="label label-success">' . $subscription->stripe_plan . '</span> <small class="text-muted">' . $subscription->stripe_id . '</small>';
            })
            ->editColumn('billing_date', function ($subscription) {
                return dateTimeFormatted($subscription->created_at);
            })
            ->editColumn('action', function ($subscription) {
                $str = '';
                if (isAdmin() || can('subscriptions_update')):
                    if ($subscription->owner->subscription($subscription->name)->onGracePeriod()) {
                        $str .= '<a href="' . route('subscriptions.admin.activate', $subscription->id) . '" class="m-l-xs btn btn-sm btn-info">' . langapp('activate') . '</a>';
                    }
                $str .= '<a href="' . route('subscriptions.admin.cancel', $subscription->id) . '" class="m-l-xs btn btn-sm btn-warning" data-toggle="ajaxModal" data-rel="tooltip" title="Cancel Subscription">' . langapp('cancel') . '</a>';
                endif;
                return $str;
            })
            ->rawColumns(['name', 'client_id', 'plan', 'billing_date', 'action'])
            ->make(true);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function plansData()
    {
        $model = SubscriptionPlan::with(['owner:id,name'])->orderBy('id', 'desc');
        return DataTables::eloquent($model)
            ->editColumn('subscriber', function ($plan) {
                return '<a href="' . route('clients.view', $plan->owner->id) . '">' . $plan->owner->name . '</a>';
            })
            ->editColumn('plan', function ($plan) {
                return '<span class="label label-success">' . $plan->stripe_plan_id . '</span>';
            })

            ->editColumn('billing_date', function ($subscription) {
                return dateTimeFormatted($subscription->billing_date);
            })
            ->editColumn('action', function ($subscription) {
                $str = '';
                $str .= '<a href="' . route('plans.edit', $subscription->id) . '" class="m-l-xs btn btn-sm btn-info" data-toggle="ajaxModal"><i class="fas fa-pencil-alt"></i></a>';
                $str .= '<a href="' . route('plans.delete', $subscription->id) . '" class="m-l-xs btn btn-sm btn-info" data-toggle="ajaxModal"><i class="far fa-trash-alt"></i></a>';
                $str .= '<a href="' . route('plans.send', $subscription->id) . '" class="m-l-xs btn btn-sm btn-success" data-toggle="ajaxModal" data-rel="tooltip" title="Send"><i class="far fa-envelope-open"></i></a>';
                return $str;
            })
            ->rawColumns(['subscriber', 'plan', 'billing_date', 'action'])
            ->make(true);
    }

    public function applyFilter()
    {
        $filter       = $this->request->filter;
        $subscription = new CustomSubscription;

        // if ($filter === 'recurring') {
        //     return $this->invoice->apply(['recurring' => 1])->whereNull('archived_at');
        // }
        return $subscription->query()->where(function ($query) {
            $query->whereNull('ends_at')->orWhere('ends_at', '>', now())->orWhereNotNull('trial_ends_at')->where('trial_ends_at', '>', today());
        });
    }
}
