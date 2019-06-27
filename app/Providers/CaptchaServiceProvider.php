<?php

namespace App\Providers;

use App\Services\NoCaptcha;
use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
        $app['validator']->extend(
            'captcha',
            function ($attribute, $value) use ($app) {
                return $app['captcha']->verifyResponse($value, $app['request']->getClientIp());
            }
        );

        if ($app->bound('form')) {
            $app['form']->macro(
                'captcha',
                function ($attributes = []) use ($app) {
                    return $app['captcha']->display($attributes, $app->getLocale());
                }
            );
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'captcha',
            function ($app) {
                return new NoCaptcha(
                    $app['config']['captcha.secret'],
                    $app['config']['captcha.sitekey'],
                    $app['config']['captcha.options']
                );
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['captcha'];
    }
}
