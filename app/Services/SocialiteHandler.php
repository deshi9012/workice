<?php

namespace App\Services;

use App\Entities\SocialiteAccount;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Modules\Users\Entities\User;

class SocialiteHandler
{
    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        $account = SocialiteAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new SocialiteAccount(
                [
                'provider_user_id' => $providerUser->getId(),
                'provider'         => $provider,
                ]
            );
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create(
                    [
                    'email'    => $providerUser->getEmail(),
                    'username' => $providerUser->getEmail(),
                    'name'     => $providerUser->getName(),
                    'password' => bcrypt(str_random(8)),
                    'email_verified_at' => now()->toDateTimeString()
                    ]
                );
                $user->profile->update(['avatar' => $providerUser->getAvatar(), 'company' => 0]);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}
