<?php

namespace App\Http\Middleware;

use Closure;

class Reauthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((strtotime('now') - $request->session()->get('last_reauth', 0)) > config('reauthenticate.timeout', 21600)) {
            $uri = $request->route()->action['prefix'] == '/settings' ? 'settings' : $request->route()->uri();
            $request->session()->put('reauth.requested_url', $uri);

            return redirect()->route(config('reauthenticate.route'));
        }
        if (config('reauthenticate.reset', true)) {
            $request->session()->put('last_reauth', strtotime('now'));
        }

        return $next($request);
    }
}
