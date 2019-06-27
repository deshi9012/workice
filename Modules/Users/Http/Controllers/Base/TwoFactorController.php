<?php

namespace Modules\Users\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Modules\Users\Notifications\TwoFactorDisabledAlert;
use Modules\Users\Notifications\TwoFactorEnabledAlert;

class TwoFactorController extends Controller
{
    /**
     * GooglesFa instance
     *
     * @var mixed
     */
    protected $google2fa;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->google2fa = app('pragmarx.google2fa');
    }

    public function twoFactor()
    {
        $google2fa_secret = $this->google2fa->generateSecretKey();
        // Generate the QR image for 2FA
        $QR_Image = $this->google2fa->getQRCodeInline(
            config('app.name'),
            \Auth::user()->email,
            $google2fa_secret
        );
        return view('users::modal.2fa', ['QR_Image' => $QR_Image, 'secret' => $google2fa_secret]);
    }

    public function complete($secret = null)
    {
        \Auth::user()->update(['google2fa_enable' => 1, 'google2fa_secret' => $secret]);
        \Auth::user()->notify(new TwoFactorEnabledAlert());
        toastr()->success('2FA enabled successfully', langapp('response_status'));
        return redirect()->route('users.profile');
    }
    public function disable()
    {
        \Auth::user()->update(['google2fa_enable' => 0]);
        \Auth::user()->notify(new TwoFactorDisabledAlert());
        toastr()->warning('2FA disabled successfully', langapp('response_status'));
        return redirect()->route('users.profile');
    }
}
