<?php

namespace Modules\Messages\Providers;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Messages\Entities\ConversationRepository;
use Modules\Messages\Entities\MessageRepository;
use Modules\Messages\Live\Broadcast;
use Modules\Messages\Services\Talk;

class MessagesServiceProvider extends ServiceProvider
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
        app()->make('router')->aliasMiddleware('talk', \Modules\Messages\Middleware\TalkMiddleware::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBroadcast();
        $this->registerTalk();
        // $this->app->singleton('message', \Modules\Messages\Entities\Message::class);
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
            __DIR__ . '/../Config/config.php' => config_path('messages.php'),
            ],
            'config'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'messages'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/messages');

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
                        return $path . '/modules/messages';
                    },
                    \Config::get('view.paths')
                ),
                [$sourcePath]
            ),
            'messages'
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/messages');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'messages');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'messages');
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
     * Register Talk class.
     */
    protected function registerTalk()
    {
        $this->app->singleton(
            'talk',
            function (Container $app) {
                return new Talk($app['config'], $app['talk.broadcast'], $app[ConversationRepository::class], $app[MessageRepository::class]);
            }
        );

        $this->app->alias('talk', Talk::class);
    }

    /**
     * Register Talk class.
     */
    protected function registerBroadcast()
    {
        $this->app->singleton(
            'talk.broadcast',
            function (Container $app) {
                return new Broadcast($app['config']);
            }
        );

        $this->app->alias('talk.broadcast', Broadcast::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'talk',
            'talk.broadcast',
        ];
    }
}
