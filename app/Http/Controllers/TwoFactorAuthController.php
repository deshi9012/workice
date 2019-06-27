<?php

namespace App\Http\Controllers;

class TwoFactorAuthController extends Controller
{
    public function authenticate()
    {
        return redirect(url()->previous());
    }

    public function reset()
    {
        $exitCode = \Artisan::call(
            '2fa:reset',
            [
                '--email' => \Auth::user()->email,
            ]
        );
        toastr()->success('Email sent to ' . \Auth::user()->email, langapp('response_status'));
        return redirect(url()->previous());
    }
}
