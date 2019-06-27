<?php

namespace Modules\Subscriptions\Http\Controllers;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscriptions\Entities\SubscriptionPlan;

class ClientSubscriptionController extends Controller
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
        $model = $this->applyFilter()->with(['user:id,name,email'])->orderByDesc('id');
        return DataTables::eloquent($model)
            ->editColumn(
                'status',
                function ($subscription) {
                    return Auth::user()->profile->business->subscribed($subscription->name) ? langapp('subscribed') : 'Not Subscribed';
                }
            )
            ->editColumn(
                'billing_date',
                function ($subscription) {
                    return dateTimeFormatted($subscription->billing_date);
                }
            )
            ->editColumn(
                'period',
                function ($subscription) {
                    if (Auth::user()->profile->business->subscribed($subscription->name)) {
                        $sub = Auth::user()->profile->business->subscription($subscription->name)->asStripeSubscription();
                        $str = now()->createFromTimeStamp($sub->current_period_start)->format('M j, Y');
                        $str .= ' - ';
                        $str .= now()->createFromTimeStamp($sub->current_period_end)->format('M j, Y');
                        return $str;
                    } else {
                        return '--';
                    }
                }
            )
            ->editColumn(
                'action',
                function ($subscription) {
                    $str = '';
                    if (!Auth::user()->profile->business->subscribed($subscription->name)) {
                        $str .= '<a href="' . route('subscriptions.subscribe', $subscription->id) . '" target="_blank" class="m-l-xs btn btn-sm btn-success">' . langapp('subscribe') . '</a>';
                    } else {
                        if (Auth::user()->profile->business->subscription($subscription->name)->onGracePeriod()) {
                            $str .= '<a href="' . route('subscriptions.activate', $subscription->id) . '" class="m-l-xs btn btn-sm btn-info">' . langapp('activate') . '</a>';
                        }
                        $str .= '<a href="' . route('subscriptions.cancel', $subscription->id) . '" class="m-l-xs btn btn-sm btn-warning" data-toggle="ajaxModal" data-rel="tooltip" title="Cancel Subscription"><i class="fas fa-calendar-times"></i> ' . langapp('cancel') . '</a>';
                    }

                    return $str;
                }
            )
            ->rawColumns(['status', 'billing_date', 'action', 'period'])
            ->make(true);
    }

    public function applyFilter()
    {
        $filter = $this->request->filter;
        $plans  = new SubscriptionPlan;
        if ($filter === 'expired') {
            return $plans->whereDate('billing_date', '>', today());
        }
        return $plans->query();
    }
}
