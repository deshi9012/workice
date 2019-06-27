<?php

namespace Modules\Payments\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invoices\Entities\Invoice;

class GatewayController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Show pay offline form
     *
     * @return \Illuminate\View\View
     */
    public function pay(Invoice $invoice, $gateway = 'paypal')
    {
        $data['invoice'] = $invoice;
        $data['channel'] = $gateway;
        if ($gateway == 'braintree') {
            $data['token'] = $this->braintreeToken();
        }
        return view('payments::pay_online')->with($data);
    }

    public function checkout()
    {
        $this->request->validate(['id' => 'required|numeric', 'amount' => 'required', 'payment' => 'required']);
        $invoice = Invoice::find($this->request->id);
        if ($invoice->overpaid($this->request->amount)) {
            return response()->json(['message' => 'Error', 'errors' => ['amount' => ["Payment exceeds required amount"]]], 500);
        }
        $amount = $this->request->amount;
        if ($this->request->payment == 'full') {
            $amount = $invoice->due();
        }
        if ($this->request->payment == 'minimum') {
            $amount = $invoice->nextUnpaidPartial();
        }

        $data['amount']   = (float) $amount;
        $data['razorpay'] = [
            'amount'       => (int) convertCurrency($invoice->currency, $amount, 'INR') * 100,
            'reference_no' => $invoice->reference_no,
            'currency'     => $invoice->currency,
            'invoice_id'   => $invoice->id,
        ];
        $data['success'] = true;
        return $data;
    }

    protected function braintreeToken()
    {
        $gateway = new \Braintree_Gateway(
            [
                'environment' => settingEnabled('braintree_live') ? 'production' : 'sandbox',
                'merchantId'  => config('services.braintree.merchantId'),
                'publicKey'   => config('services.braintree.publicKey'),
                'privateKey'  => config('services.braintree.privateKey'),
            ]
        );
        return $gateway->clientToken()->generate();
    }
}
