<?php

namespace Modules\Payments\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class PagseguroController extends Controller
{
    protected $paymentUrl;
    protected $checkoutUrl;
    protected $notificationUrl;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request     = $request;
        $this->checkoutUrl = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=' . get_option('pagseguro_email') . '&token=' . get_option('pagseguro_token');
        $this->paymentUrl  = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html';
        if (settingEnabled('pagseguro_live')) {
            $this->paymentUrl  = 'https://pagseguro.uol.com.br/v2/checkout/payment.html';
            $this->checkoutUrl = 'https://ws.pagseguro.uol.com.br/v2/checkout/?email=' . get_option('pagseguro_email') . '&token=' . get_option('pagseguro_token');
        }
    }

    public function form()
    {
        try {
            $client   = new Client();
            $response = $client->post(
                $this->checkoutUrl,
                ['form_params' => $this->request->except('_token', 'custom', 'id', 'payment', 'amount')]
            );
            $xml   = simplexml_load_string($response->getBody()->getContents(), "SimpleXMLElement", LIBXML_NOCDATA);
            $json  = json_encode($xml);
            $array = json_decode($json, true);
            return \Redirect::to($this->paymentUrl . '?code=' . $array['code']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            toastr()->success($e->getMessage(), langapp('response_status'));
            return redirect()->route('invoices.index');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback()
    {
        toastr()->success(langapp('payment_processing'), langapp('response_status'));
        return redirect()->route('invoices.index');
    }
}
