<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Clients\Entities\Client;
use Modules\Users\Entities\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
        // if (!settingEnabled('allow_client_registration')) {
        //     $this->middleware('auth');
        // }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name'        => 'required|string|max:255',
                'email'       => 'required|string|email|max:255|unique:users',
                'password'    => 'required|string|min:6|confirmed',
                'agree_terms' => 'accepted',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \Modules\Users\Entities\User
     */
    protected function create(array $data)
    {
        $user = User::create(
            [
                'username'          => $data['email'],
                'email'             => $data['email'],
                'name'              => $data['name'],
                'password'          => $data['password'],
                'email_verified_at' => config('system.verification') ? null : now(),
            ]
        );
        $user->profile->update(
            [
                'company' => Client::firstOrCreate(
                    ['email' => $data['company_email']],
                    ['name' => $data['company'], 'primary_contact' => $user->id]
                )->id,
                'avatar'  => 'default_avatar.png',
            ]
        );
        return $user;
    }

    protected function registered(Request $request, $user)
    {
        // $user->generateToken();
        // $user->sendEmailVerificationNotification();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if (config('system.secure_password')) {
            $request->validate(['password' => 'pwned']);
        }

        $user = $this->create($request->all());

        event(new Registered($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());
    }
}
