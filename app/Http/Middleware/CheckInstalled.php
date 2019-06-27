<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class CheckInstalled
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
        /*
         * Check if the 'installed' file has been created
         */
        if (!file_exists(storage_path('installed'))) {
            return Redirect::to('installer');
        }

        /*
         * Redirect user to signup page if there are no accounts
         */
        // TODO check if there is a user
        // if (User::count() === 0 && !$request->is('register*')) {
        //     return redirect()->to('register');
        // }

        $response = $next($request);

        return $response;
    }
}
