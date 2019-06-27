<?php

namespace Modules\Expenses\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Expenses\Console\CalculateExpense;

class ExpensesServiceProvider extends ServiceProvider
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
                CalculateExpense::class,
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
        // $this->app->bind('expense', \Modules\Expenses\Entities\Expense::class);
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
                __DIR__ . '/../Config/config.php' => config_path('expenses.php'),
            ],
            'config'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'expenses'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/expenses');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes(
            [
                $sourcePath => $viewPath,
            ],
            'views'
        );

        $this->loadViewsFrom(
            array_merge(
                array_map(
                    function ($path) {
                        return $path . '/modules/expenses';
                    },
                    \Config::get('view.paths')
                ),
                [$sourcePath]
            ),
            'expenses'
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/expenses');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'expenses');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'expenses');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (!app()->environment('production')) {
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
