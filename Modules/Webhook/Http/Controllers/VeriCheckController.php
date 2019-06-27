<?php

namespace Modules\Webhook\Http\Controllers;

use App\Http\Controllers\Controller;
use Crypt;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Storage;

class VeriCheckController extends Controller
{
    protected $message;
    /**
     * Verify purchase
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $this->message = 'Server unreachable or demo activated';
        if (urlAccessible($this->getEndPoint()) && !isDemo()) {
            $code = $request->has('code') ? $request->code : get_option('purchase_code');
            try {
                $this->query($code);
            } catch (Exception $e) {
                $this->shutDown();
            }
            return response()->json(['status' => 'success', 'message' => $this->message], 200);
        } else {
            return response()->json(['status' => 'failed', 'message' => $this->message], 500);
        }
    }

    private function query($code)
    {
        $client   = new Client();
        $response = $client->get($this->getEndPoint() . '?code=' . $code);
        $response = collect(json_decode($response->getBody()->getContents()));
        if ($response->has('error')) {
            $this->shutDown();
            $this->message = 'Current license is invalid. Application deactivated for ' . get_option('company_email');
            return false;
        }
        if ($response->has('item_id')) {
            $this->message = 'Purchase verified successfully';
            return $this->turnOn($response);
        }
        $this->shutDown();
        return false;
    }
    private function turnOn(Collection $response)
    {
        return Storage::put('verified.json', Crypt::encryptString($response->toJson()));
    }

    private function shutDown()
    {
        if (Storage::exists('verified.json')) {
            Storage::delete('verified.json');
        }
    }

    private function getEndPoint()
    {
        return 'https://sales.gitbench.com/verify';
    }
}
