<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class OverrideConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Config::set([
            'paypal.mode'            => settingEnabled('paypal_live') ? 'live' : 'sandbox',
            'cookie-consent.enabled' => settingEnabled('cookie_consent'),
        ]);

        return $next($request);
    }
}
