<?php

namespace Modules\Tickets\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Tickets\Console\AutoCloseTicket;
use Modules\Tickets\Console\TicketEmails;
use Modules\Tickets\Console\TicketFeedback;

class TicketsServiceProvider extends ServiceProvider
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
            AutoCloseTicket::class,
            TicketEmails::class,
            TicketFeedback::class
            ]
        );
        // \View::composer('tickets::view', function ($view) {
        //     $view->with('users', User::select('id')->whereActivated(1)->get());
        // });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('ticket', \Modules\Tickets\Entities\Ticket::class);
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
            __DIR__ . '/../Config/config.php' => config_path('tickets.php'),
            ], 'config'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'tickets'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/tickets');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes(
            [
            $sourcePath => $viewPath,
            ], 'views'
        );

        $this->loadViewsFrom(
            array_merge(
                array_map(
                    function ($path) {
                        return $path . '/modules/tickets';
                    }, \Config::get('view.paths')
                ), [$sourcePath]
            ), 'tickets'
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/tickets');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'tickets');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'tickets');
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
