<?php

namespace Modules\Users\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

abstract class NotificationController extends Controller
{
    protected $request;

    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
    }

    public function notifications()
    {
        $data['page'] = $this->getPage();

        return view('users::notifications')->with($data);
    }
    public function preferences()
    {
        if (isAdmin()) {
            $data['page'] = $this->getPage();
            return view('users::preferences')->with($data);
        }
        abort(404);
    }
    public function savePreferences()
    {
        \Auth::user()->update(['email_preferences' => $this->request->except('_token')]);
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function clearAlerts()
    {
        \Auth::user()->unreadNotifications->markAsRead();
        $data['message']  = langapp('action_completed');
        $data['redirect'] = url()->previous();
        return ajaxResponse($data);
    }

    private function getPage()
    {
        return langapp('profile');
    }
}
