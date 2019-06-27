<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function ticket()
    {
        return view('modal.support');
    }
}
