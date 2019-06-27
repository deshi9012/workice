<?php

namespace App\Http\Controllers;

use App\Entities\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Users\Emails\InviteCreated;
use Modules\Users\Entities\User;

class InviteController extends Controller
{
    public function invite()
    {
        // show the user a form with an email field to invite a new user
        return view('modal.invite');
    }

    public function process(Request $request)
    {
        $request->validate(['email' => 'required|email|string|max:255|unique:users']);
        do {
            $token = str_random();
        } while (Invite::where('token', $token)->first());
        $invite = Invite::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token]
        );
        Mail::to($request->email)->send(new InviteCreated($invite));
        $data['message'] = langapp('invitation_sent');
        $data['redirect'] = url()->previous();
        return ajaxResponse($data);
    }

    public function accept($token)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            abort(404);
        }
        $data['email'] = $invite->email;

        return view('auth.invitation')->with($data);
    }

    public function accepted(Request $request)
    {
        $request->validate(
            [
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|pwned',
            'verified' => 'required|numeric',
            'name' => 'required',
            'agree_terms' => 'accepted'
            ]
        );
        $user = User::create($request->only(['username', 'email','password', 'verified']));
        $user->profile->update($request->only(['job_title']));
        Invite::where('email', $user->email)->first()->delete();

        \Auth::login($user, true);
        return redirect('/');
    }
}
