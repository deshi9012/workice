<?php
namespace App\Services;

use PragmaRX\Google2FALaravel\Exceptions\InvalidSecretKey;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class Google2FAAuthenticator extends Authenticator
{
    protected function canPassWithoutCheckingOTP()
    {
        return
        !$this->getUser()->google2fa_enable ||
        !$this->isEnabled() ||
        $this->noUserIsAuthenticated() ||
        $this->twoFactorAuthStillValid();
    }
    protected function getGoogle2FASecretKey()
    {
        $secret = $this->getUser()->{$this->config('otp_secret_column')};
        if (is_null($secret) || empty($secret)) {
            throw new InvalidSecretKey('Secret key cannot be empty.');
        }
        return $secret;
    }
}
