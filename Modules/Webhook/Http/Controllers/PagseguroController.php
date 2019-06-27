<?php

namespace Modules\Webhook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;

class PagseguroController extends Controller
{
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
        $this->notificationUrl = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/';
        if (settingEnabled('pagseguro_live')) {
            $this->notificationUrl = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/';
        }
    }

    /**
     * Query transaction using Pagseguro API
     */
    public function ipn()
    {
        try {
            $client = new Client();
            $response = $client->get($this->notificationUrl.$this->request->notificationCode.'?email=' . get_option('pagseguro_email') . '&token=' . get_option('pagseguro_token'));
            $xml = simplexml_load_string($response->getBody()->getContents(), "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $tr = json_decode($json, true);
            // If status is pay
            if ($tr['status'] == 3) {
                $payment = (new \Modules\Payments\Helpers\PaymentEngine('pagseguro', $tr))->transact();
                return response()->json(['message' => 'Success'], 200);
            } else {
                \Log::info($tr);
                return response()->json(['message' => 'Transaction '.$tr['code'].' status is not paid'], 500);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
