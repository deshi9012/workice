<?php

namespace Modules\Analytics\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class AnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->commands(
            [
            \Modules\Analytics\Console\AnalyticsCompute::class,
            \Modules\Analytics\Console\ComputeInvoices::class,
            \Modules\Analytics\Console\ComputePayments::class,
            \Modules\Analytics\Console\ComputeCredits::class,
            \Modules\Analytics\Console\ComputeExpenses::class,
            \Modules\Analytics\Console\ComputeEstimates::class,
            \Modules\Analytics\Console\ComputeDeals::class,
            \Modules\Analytics\Console\ComputeLeads::class,
            \Modules\Analytics\Console\ComputeProjects::class,
            \Modules\Analytics\Console\ComputeTasks::class,
            \Modules\Analytics\Console\ComputeTickets::class,
            \Modules\Analytics\Console\ComputeTimesheets::class,
            ]
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes(
            [
            __DIR__.'/../Config/config.php' => config_path('analytics.php'),
            ], 'config'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php',
            'analytics'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/analytics');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes(
            [
            $sourcePath => $viewPath
            ], 'views'
        );

        $this->loadViewsFrom(
            array_merge(
                array_map(
                    function ($path) {
                        return $path . '/modules/analytics';
                    }, \Config::get('view.paths')
                ), [$sourcePath]
            ), 'analytics'
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/analytics');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'analytics');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'analytics');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
