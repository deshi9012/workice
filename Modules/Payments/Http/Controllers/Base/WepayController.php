<?php

namespace Modules\Payments\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Invoices\Entities\Invoice;

abstract class WepayController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Invoice Model
     *
     * @var \Modules\Invoices\Entities\Invoice
     */
    protected $invoice;
    protected $accountId;
    protected $clientId;
    protected $secretId;
    protected $accessToken;

    public function __construct(Request $request)
    {
        $this->request     = $request;
        $this->invoice     = new Invoice;
        $this->accountId   = config('services.wepay.accountId');
        $this->clientId    = config('services.wepay.clientId');
        $this->secretId    = config('services.wepay.secretId');
        $this->accessToken = config('services.wepay.accessToken');
    }

    public function checkout()
    {
        $this->request->validate(
            [
                'amount' => 'required',
                'id'     => 'required|numeric',
            ]
        );
        $invoice = $this->invoice->find($this->request->id);
        try {
            if (settingEnabled('wepay_live')) {
                \WePay::useProduction($this->clientId, $this->secretId);
            } else {
                \WePay::useStaging($this->clientId, $this->secretId);
            }
            $wepay    = new \WePay($this->accessToken);
            $checkout = $wepay->request(
                'checkout/create', array(
                'account_id'        => $this->accountId,
                'amount'            => $this->request->amount,
                'short_description' => 'Payment for invoice ' . $invoice->reference_no,
                'type'              => 'service',
                'currency'          => $invoice->currency,
                'reference_id'      => json_encode(['invoice_id' => $invoice->id]),
                'callback_uri'      => route('wepay.webhook'),
                'hosted_checkout'   => array(
                    'redirect_uri' => route('payments.wepay.callback'),
                    'mode'         => 'regular',
                ),
                'fee'               => array(
                    'fee_payer' => 'payee',
                ),
                )
            );

            return ajaxResponse(
                [
                    'message'  => 'Redirecting to Wepay Gateway',
                    'redirect' => $checkout->hosted_checkout->checkout_uri,
                ],
                true,
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            toastr()->error('Payment failed please contact admin', langapp('response_status'));
            return redirect()->route('invoices.index');
        }
    }
    public function callback()
    {
        \Storage::put('/txn/_' . $this->request->checkout_id . '.json', json_encode($this->request->all()));
        toastr()->info('Your payment will be processed shortly', langapp('response_status'));
        return redirect()->route('invoices.index');
    }
}
