<?php

namespace Modules\Webhook\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalWebhookController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function ipn()
    {
        $provider = new ExpressCheckout;

        $this->request->merge(['cmd' => '_notify-validate']);
        $post     = $this->request->all();
        $response = (string) $provider->verifyIPN($post);

        if ($response === 'VERIFIED') {
            $txn = (new \Modules\Payments\Helpers\PaymentEngine('paypal', $post))->transact();
            return ajaxResponse(
                [
                    'message' => 'Payment completed successfully',
                ],
                true,
                Response::HTTP_OK
            );
        }
        \Log::error('Paypal sent response ' . $response);
        return response()->json(
            [
                'status'  => 'error',
                'message' => 'An error occurred!'],
            500
        );
    }
}
