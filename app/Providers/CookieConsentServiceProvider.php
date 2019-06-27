<?php
namespace App\Providers;

use Cookie;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\ServiceProvider;

class CookieConsentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->resolving(
            EncryptCookies::class, function (EncryptCookies $encryptCookies) {
                $encryptCookies->disableFor(config('cookie-consent.cookie_name'));
            }
        );
        $this->app['view']->composer(
            'cookie_consent', function (View $view) {
                $cookieConsentConfig         = config('cookie-consent');
                $alreadyConsentedWithCookies = Cookie::has($cookieConsentConfig['cookie_name']);
                $view->with(compact('alreadyConsentedWithCookies', 'cookieConsentConfig'));
            }
        );
    }
}
