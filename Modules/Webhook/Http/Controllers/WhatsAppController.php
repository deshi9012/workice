<?php

namespace Modules\Webhook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WhatsAppController extends Controller
{
    /**
     * Receive callback POST from nexmo
     * @return Response
     */
    public function callback(Request $request)
    {
        \Log::error($request->all());

        return view('webhook::index');
    }

    public function status(Request $request)
    {
        \Log::error($request->all());

        return view('webhook::index');
    }
}
