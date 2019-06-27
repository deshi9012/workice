<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        return view('projects::modal.default_settings');
    }

    public function save(Request $request)
    {
        update_option('default_project_settings', json_encode($request->except(['_token'])));
        \Cache::forget(settingsCacheName());
        $data['message']  = langapp('action_completed');
        $data['redirect'] = url()->previous();
        return ajaxResponse($data);
    }
}
