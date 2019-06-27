<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        // \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
        // \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
        // \RenatoMarinho\LaravelPageSpeed\Middleware\TrimUrls::class,
        // \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveQuotes::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,
        \App\Http\Middleware\CheckXSS::class,
        \App\Http\Middleware\FilterIfPjax::class,
        \Bepsvpt\SecureHeaders\SecureHeadersMiddleware::class,
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\OverrideConfig::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Http\Middleware\FrameGuard::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
            \App\Http\Middleware\Locale::class,
            \App\Http\Middleware\Workice::class,
            \App\Http\Middleware\CheckBanned::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'               => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'         => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'           => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'                => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'              => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'           => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'mailgun'            => \App\Http\Middleware\ValidateMailgunWebhook::class,
        'impersonate'        => \App\Http\Middleware\Impersonate::class,
        'reauthenticate'     => \App\Http\Middleware\Reauthenticate::class,
        'cors'               => \App\Http\Middleware\Cors::class,
        'verified'           => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'license'            => \App\Http\Middleware\Workice::class,
        'cache.headers'      => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'signed'             => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'demo'               => \App\Http\Middleware\DemoMode::class,
        'installed'          => \App\Http\Middleware\CheckInstalled::class,
        'role'               => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission'         => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
        '2fa'                => \App\Http\Middleware\Google2FAMiddleware::class,
        'localize'           => \App\Http\Middleware\Localization::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    // protected $middlewarePriority = [
    //     \Illuminate\Session\Middleware\StartSession::class,
    //     \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    //     \App\Http\Middleware\Authenticate::class,
    //     \Illuminate\Session\Middleware\AuthenticateSession::class,
    //     \Illuminate\Routing\Middleware\SubstituteBindings::class,
    //     \Illuminate\Auth\Middleware\Authorize::class,
    // ];
}
