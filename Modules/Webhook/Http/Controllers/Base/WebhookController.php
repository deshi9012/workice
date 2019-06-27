<?php

namespace Modules\Webhook\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;
    /**
     * Code
     *
     * @var string
     */
    protected $code;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->code = $this->request->code;
    }
}
