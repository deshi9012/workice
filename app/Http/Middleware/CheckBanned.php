<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->banned) {
            auth()->logout();
            toastr()->warning('Your account has been suspended. Please contact administrator.', langapp('response_status'));
            return redirect()->route('login');
        }

        return $next($request);
    }
}
