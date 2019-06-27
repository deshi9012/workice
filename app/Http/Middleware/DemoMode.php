<?php

namespace App\Http\Middleware;

use Closure;

class DemoMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isDemo()) {
            if (! $request->wantsJson()) {
                abort(403);
            }
            return \Response::json(
                [
                'errors' => [
                    'message' => ['Not allowed in demo mode'],
                ]
                ],
                401
            );
        }
        
        return $next($request);
    }
}
