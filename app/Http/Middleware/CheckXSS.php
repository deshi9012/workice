<?php

namespace App\Http\Middleware;

use Closure;

class CheckXSS
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
        $input = $request->all();
        array_walk_recursive(
            $input, function (&$input) {
                $input = strip_tags($input, '<strong><a>');
            }
        );
        $request->merge($input);

        return $next($request);
    }
}
