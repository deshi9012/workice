<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \App\Exceptions\PurNotVerifiedException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return mixed
     */
    public function render($request, Exception $exception)
    {
        // This will replace our 404 response with
        // a JSON response // && $request->wantsJson()
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json(
                [
                    'errors' => [
                        'message' => 'Resource data missing',
                    ],
                ],
                404
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException && config('app.env') == 'production') {
            return abort(404);
        }

        // if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
        //     if ($request->ajax()) {
        //         return response()->view('errors.modal.403');
        //     }
        //     return redirect('/error/403');
        // }

        // if ($exception instanceof UserNotVerifiedException) {
        //     return response()->view('vendor.laravel-user-verification.user-verification', [], 401);
        // }
        if ($exception instanceof PurNotVerifiedException) {
            return response()->view('errors.license', [], 401);
        }
        // if ($exception instanceof \PDOException) {
        //     return response()->view('errors.dbconnect', [], 500);
        // }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return mixed
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
