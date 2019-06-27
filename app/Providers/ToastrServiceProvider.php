<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Toastr;

class ToastrServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'toastr', function ($app) {
                return new Toastr($app['session'], $app['config']);
            }
        );
    }

    /**
     * Get the services provider by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ['toastr'];
    }
}
