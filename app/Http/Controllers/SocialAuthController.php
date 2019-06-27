<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialiteHandler;

class SocialAuthController extends Controller
{
    /**
     * Create a redirect method to oauth api.
     *
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Return a callback method from oauth api.
     *
     * @return mixed URL from oauth provider
     */
    public function handleProviderCallback($provider, SocialiteHandler $service)
    {
        try {
            $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);
            auth()->login($user);
            return redirect()->to('/');
        } catch (\Exception $e) {
            toastr()->error('Authorization failed! '.$e->getMessage(), langapp('response_status'));
            return redirect('/login');
        }
    }
}
