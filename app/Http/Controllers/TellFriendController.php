<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Users\Emails\TellAFriend;

class TellFriendController extends Controller
{
    public function share()
    {
        return view('modal.share');
    }

    public function invite(Request $request)
    {
        $request->validate(
            [
            'email' => 'required|email|string|max:255|unique:users',
            'anti_spam' => 'required|accepted'
            ]
        );
        
        Mail::to($request->email)->send(new TellAFriend($request->email, \Auth::user()->name));
        $data['message'] = langapp('invitation_sent');
        $data['redirect'] = url()->previous();
        return ajaxResponse($data);
    }
}
