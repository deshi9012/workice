<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Date\Date;

class Localization
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // read the language from the request header
        $locale = $request->header('Content-Language');

        // if the header is missed
        if (!$locale) {
            // take the default local language
            $locale = app()->config->get('app.locale');
        }

        // check the languages defined is supported
        if (!array_key_exists($locale, array_flip(array_pluck(languages(), 'code')))) {
            // respond with error
            return abort(403, 'Language not supported.');
        }

        // set the local language
        app()->setLocale($locale);

        Date::setLocale($locale);

        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Content-Language', $locale);

        // return the response
        return $response;
    }
}
