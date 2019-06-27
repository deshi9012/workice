<?php

namespace Modules\Webhook\Http\Controllers;

use App\Entities\AcceptPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Entities\Payment;
use Modules\Webhook\Jobs\RazorPayWebhookJob;
use Razorpay\Api\Api;

class RazorPayWebhookController extends Controller
{
    protected $request;
    protected $invoice;
    protected $api;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->invoice = new Invoice;
        $this->api     = new Api(config('services.razorpay.keyId'), config('services.razorpay.secretKey'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function capture()
    {
        try {
            $payment = $this->api->payment->fetch($this->request->id);
            $payment = $payment->capture(array('amount' => $this->request->amount));

            if ($payment->status == 'captured') {
                $txn = (new \Modules\Payments\Helpers\PaymentEngine('razorpay', $payment))->transact();
            }
            return ajaxResponse(
                [
                    'message'  => 'Payment processed successfully',
                    'redirect' => route('invoices.view', $payment->notes->invoice_id),
                ],
                true,
                Response::HTTP_OK
            );
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return ajaxResponse(
                [
                    'message'  => 'Payment failed please contact admin',
                    'redirect' => route('invoices.index'),
                ],
                false,
                500
            );
        }
    }

    public function ipn()
    {
        $signature = $this->request->header('X-Razorpay-Signature');
        $this->api->utility->verifyWebhookSignature($this->request->getContent(), $signature, config('services.razorpay.secretKey'));
        if ($this->request->event == 'payment.captured') {
            $data = [
                'invoice_id'     => $this->request->payload['payment']['entity']['notes']['invoice_id'],
                'amount'         => $this->request->payload['payment']['entity']['notes']['amount'],
                'payment_method' => AcceptPayment::where('method_name', 'Razorpay')->first()->method_id,
            ];
            $payment = Payment::where($data)->count();
            if ($payment == 0) {
                RazorPayWebhookJob::dispatch($data)->delay(now()->addMinutes(2));
            }
            \Storage::put('/txn/_' . $this->request->payload['payment']['entity']['id'] . '.json', json_encode($this->request->all()));
        }
    }
}
