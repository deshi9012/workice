<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function fourZeroThree()
    {
        return response()->view('errors.403');
    }
}
