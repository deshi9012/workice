<?php

namespace Modules\Webhook\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Webhook\Http\Requests\ErrorRequest;

class BugTrackerController extends Controller
{
    public function report()
    {
        return view('webhook::modal.error');
    }
}
