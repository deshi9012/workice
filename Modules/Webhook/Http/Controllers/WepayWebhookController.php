<?php

namespace Modules\Webhook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Invoices\Entities\Invoice;

class WepayWebhookController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;
    /**
     * Invoice Model
     *
     * @var Invoice
     */
    protected $invoice;

    protected $accountId;
    protected $clientId;
    protected $secretId;
    protected $accessToken;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->invoice = new Invoice;

        $this->accountId   = config('services.wepay.accountId');
        $this->clientId    = config('services.wepay.clientId');
        $this->secretId    = config('services.wepay.secretId');
        $this->accessToken = config('services.wepay.accessToken');
    }

    /**
     * Verify Payments via WePay
     */
    public function ipn()
    {
        if (settingEnabled('wepay_live')) {
            \WePay::useProduction($this->clientId, $this->secretId);
        } else {
            \WePay::useStaging($this->clientId, $this->secretId);
        }
        $wepay = new \WePay($this->accessToken);
        try {
            $response = $wepay->request(
                '/checkout',
                array(
                    'checkout_id' => $this->request->checkout_id,
                )
            );
            $reference = json_decode($response->reference_id);

            if ($response->state == 'released') {
                $payment = (new \Modules\Payments\Helpers\PaymentEngine('wepay', $response))->transact();
                return ajaxResponse(['message' => 'Payment completed successfully'], true, Response::HTTP_OK);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw new \Exception('Payment failed');
        }
    }
}
