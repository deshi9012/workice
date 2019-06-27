<?php

namespace Modules\Webhook\Http\Controllers;

use App\Entities\AcceptPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Payments\Entities\Payment;
use Mollie\Laravel\Facades\Mollie;

class MollieWebhookController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;
    /**
     * Payment Model
     *
     * @var Payment
     */
    protected $payment;
    
    public function __construct(Request $request, Payment $payment)
    {
        $this->request = $request;
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function ipn()
    {
        if (! $this->request->has('id')) {
            return;
        }
        $payment = Mollie::api()->payments()->get($this->request->id);

        if ($payment->isPaid()) {
            $txn = (new \Modules\Payments\Helpers\PaymentEngine('mollie', $payment))->transact();
            return ajaxResponse(
                [
                'message' => 'Payment completed successfully',
                ],
                true,
                Response::HTTP_OK
            );
        }
        if ($payment->isCanceled()) {
            $method_id = AcceptPayment::where('method_name', 'mollie')->first()->method_id;
            $payment = $this->payment->where(['payment_method' => $method_id, 'amount' => $payment->amount->value])->first();
            $payment->update(['is_refunded' => 1]);
            return ajaxResponse(
                [
                'message' => 'Payment cancelled successfully',
                ],
                true,
                Response::HTTP_OK
            );
        }
    }
}
