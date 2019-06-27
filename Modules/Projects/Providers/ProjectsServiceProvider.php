<?php

namespace Modules\Projects\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Projects\Console\CalculateProject;
use Modules\Projects\Console\Overbudget;

class ProjectsServiceProvider extends ServiceProvider
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
                CalculateProject::class,
                Overbudget::class,
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
        $this->app->singleton('project', \Modules\Projects\Entities\Project::class);
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
                __DIR__ . '/../Config/config.php' => config_path('projects.php'),
            ],
            'config'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'projects'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/projects');

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
                        return $path . '/modules/projects';
                    },
                    \Config::get('view.paths')
                ),
                [$sourcePath]
            ),
            'projects'
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/projects');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'projects');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'projects');
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
