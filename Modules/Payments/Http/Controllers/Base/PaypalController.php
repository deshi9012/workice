<?php

namespace Modules\Payments\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class PaypalController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        toastr()->warning('Payment was cancelled by user', langapp('response_status'));
        return redirect()->route('invoices.index');
    }
    /**
     * Accept paypal success request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        \Storage::put('/txn/_' . $this->request->txn_id . '.json', json_encode($this->request->all()));
        toastr()->success('Payment received successfully', langapp('response_status'));
        return redirect()->route('invoices.index');
    }
}
