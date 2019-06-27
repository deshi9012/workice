<?php

namespace Modules\Payments\Http\Controllers\Base;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invoices\Entities\Invoice;
use Modules\Payments\Jobs\RecheckPaytmStatus;

class PaytmController extends Controller
{
    public function __construct()
    {
        $this->invoice = new Invoice;
    }

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function order(Request $request)
    {
        $invoice = $this->invoice->find($request->id);
        $payment = PaytmWallet::with('receive');
        $payment->prepare([
            'order'         => $invoice->id . '-' . trCode(),
            'user'          => $invoice->client_id,
            'mobile_number' => empty($invoice->company->mobile) ? 'xxx' : $invoice->company->mobile,
            'email'         => $invoice->company->email,
            'amount'        => $request->amount,
            'callback_url'  => route('paytm.status'),
        ]);
        return $payment->receive();
    }

    /**
     * Obtain the payment information.
     *
     * @return Object
     */
    public function callback()
    {
        $transaction = PaytmWallet::with('receive');

        $response  = $transaction->response(); // To get raw response as array
        $invoiceId = $this->getInvoiceId($response['ORDERID']);
        \Storage::put('/txn/_' . $response['ORDERID'] . '.json', json_encode($response));

        if ($transaction->isSuccessful()) {
            $payment = (new \Modules\Payments\Helpers\PaymentEngine('paytm', $response))->transact();
            toastr()->success('Payment received successfully', langapp('response_status'));
            return redirect()->route('invoices.index');
        }
        // Schedule Job to check transaction
        RecheckPaytmStatus::dispatch($response['ORDERID'])->delay(now()->addMinutes(3));
        toastr()->warning('We will verify your transaction shortly', langapp('response_status'));
        return redirect()->route('invoices.index');
    }

    public function getInvoiceId($orderId)
    {
        return (int) substr($orderId, 0, strpos($orderId, "-"));
    }
}
