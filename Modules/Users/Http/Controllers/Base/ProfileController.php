<?php

namespace Modules\Users\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Contracts\Entities\Signature;
use Modules\Users\Http\Requests\ProfileChangeRequest;

abstract class ProfileController extends Controller
{
    /**
     * Avatar directory path
     *
     * @var string
     */
    protected $avatar_dir;
    /**
     * Signatures directory path
     *
     * @var string
     */
    protected $signature_dir;

    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'verified', 'reauthenticate']);
        $this->avatar_dir    = config('system.avatar_dir') . '/';
        $this->signature_dir = config('system.signature_dir') . '/';
    }

    /**
     * Show user profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $data['page'] = $this->getPage();

        return view('users::profile')->with($data);
    }
    /**
     * Show user profile.
     *
     * @return \Illuminate\View\View
     */
    public function apiSetup()
    {
        $data['page'] = $this->getPage();

        return view('users::api')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function reminders()
    {
        $data['page'] = $this->getPage();
        return view('users::reminders')->with($data);
    }

    public function change(ProfileChangeRequest $request)
    {
        $user = \Auth::user();
        $user->update(
            $request->except(
                [
                    'profile', 'company', 'confirm_password', 'avatar', 'signature', 'channels',
                ]
            )
        );
        $channels = $request->has('profile.channels') ? array_keys($request->profile['channels']) : [];
        $user->profile->update($request->profile);
        $user->profile->update(['channels' => $channels]);
        $user->profile->company > 0 ? \Auth::user()->profile->business->update($request->company) : false;

        if ($request->hasFile('avatar')) {
            $this->uploadAvatar($request);
        }

        if ($request->hasFile('signature')) {
            $this->uploadSignature($request);
        }

        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    protected function uploadAvatar($request)
    {
        $currentAvatar = \Auth::user()->profile->avatar;
        if (Storage::exists($this->avatar_dir . $currentAvatar) && $currentAvatar != 'default_avatar.png') {
            Storage::delete($this->avatar_dir . $currentAvatar);
        }
        Storage::putFile($this->avatar_dir, $request->file('avatar'), 'public');
        \Auth::user()->profile->update(['avatar' => $request->avatar->hashName()]);
    }

    protected function uploadSignature($request)
    {
        $currentSignature = \Auth::user()->profile->signature;
        if (!is_null($currentSignature)) {
            Storage::delete($this->signature_dir . $currentSignature);
        }
        Storage::putFile($this->signature_dir, $request->file('signature'));
        \Auth::user()->profile->update(['signature' => $request->signature->hashName()]);
        Signature::whereImage($currentSignature)->update(['image' => $request->signature->hashName()]);
    }

    private function getPage()
    {
        return langapp('profile');
    }
}
