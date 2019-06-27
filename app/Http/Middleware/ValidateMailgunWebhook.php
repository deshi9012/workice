<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ValidateMailgunWebhook
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
        if (!$request->isMethod('post')) {
            abort(Response::HTTP_FORBIDDEN, 'Only POST requests are allowed.');
        }

        if ($this->verify($request)) {
            return $next($request);
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    protected function buildSignature($request)
    {
        return hash_hmac(
            'sha256',
            sprintf('%s%s', $request->input('timestamp'), $request->input('token')),
            config('services.mailgun.secret')
        );
    }

    protected function verify($request)
    {
        if (abs(time() - $request->input('timestamp')) > 15) {
            return false;
        }

        return $this->buildSignature($request) === $request->input('signature');
    }
}
