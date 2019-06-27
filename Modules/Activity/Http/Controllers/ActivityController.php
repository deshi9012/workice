<?php

namespace Modules\Activity\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        dd('Your activity');
    }
    public function pusherAuth(Request $request)
    {
        $app_id = config('talk.broadcast.pusher.app_id');
        $app_key = config('talk.broadcast.pusher.app_key');
        $app_secret = config('talk.broadcast.pusher.app_secret');
        $app_cluster = config('talk.broadcast.pusher.options.cluster');


        $pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id, array('cluster' => $app_cluster));
        $auth = $pusher->socket_auth($request->channel_name, $request->socket_id);
        return $auth;
    }
}
