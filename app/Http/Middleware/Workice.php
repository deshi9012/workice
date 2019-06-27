<?php

namespace App\Http\Middleware;

use App;
use App\Exceptions\PurNotVerifiedException;
use Closure;

class Workice
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
        if ($request->path() != 'license/verify' && $request->path() != 'webhook/verifier') {
            $this->purCheck();
        }
        return $next($request);
    }

    /**
     *
     * @throws PurNotVerifiedException
     */
    protected function purCheck()
    {
        if (cache('verified') != true) {
            if (\Storage::exists('verified.json')) {
                cache(['verified' => true], now()->addDays(5));
                return true;
            }
            throw new PurNotVerifiedException();
        }
    }
}
