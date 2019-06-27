<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReauthenticateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'verified']);
    }

    public function reauthenticate()
    {
        return view('auth.reauthenticate');
    }

    public function processReauthenticate(Request $request)
    {
        $hashed = $request->user()->password;
        if (Hash::needsRehash($hashed)) {
            $hashed = Hash::make($request->password);
        }
        if (Hash::check($request->password, $hashed)) {
            $request->session()->put('last_reauth', strtotime('now'));

            return redirect($request->session()->get('reauth.requested_url', '/'));
        }

        toastr()->error('Something went wrong please check your password', langapp('response_status'));

        return back();
    }
}
