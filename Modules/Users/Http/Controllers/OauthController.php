<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class OauthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'verified']);
    }

    /**
     * Show user profile.
     *
     * @return \Illuminate\View\View
     */
    public function oauthClient()
    {
        return view('users::modal.oauth_client');
    }
    /**
     * Show user profile.
     *
     * @return \Illuminate\View\View
     */
    public function oauthToken()
    {
        return view('users::modal.oauth_token');
    }
    /**
     * Show user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tokenRecreate()
    {
        \Auth::user()->update(['access_token' => \Auth::user()->createToken('Access Token')->accessToken]);
        $data['message']  = langapp('action_completed');
        $data['redirect'] = '/users/api-setup';

        return ajaxResponse($data);
    }
    /**
     * Show user profile.
     *
     * @return \Illuminate\View\View
     */
    public function oauthUpdateClient($id = null)
    {
        $data['client'] = \DB::table('oauth_clients')->whereId($id)->first();
        return view('users::modal.oauth_update_client')->with($data);
    }

    /**
     * Show user profile.
     *
     * @return \Illuminate\View\View
     */
    public function oauthDeleteClient($id = null)
    {
        $data['client'] = \DB::table('oauth_clients')->whereId($id)->first();
        return view('users::modal.oauth_delete_client')->with($data);
    }
}
