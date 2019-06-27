<?php

namespace App\Http\Middleware;

use App;
use Carbon\Carbon;
use Closure;
use Jenssegers\Date\Date;
use Session;

class Locale
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
        $locale = get_option('locale');
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        Date::setLocale($locale);
        App::setLocale($locale);
        Carbon::setLocale($locale);
        return $next($request);
    }
}
