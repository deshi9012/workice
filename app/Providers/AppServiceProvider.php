<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Modules\Settings\Entities\Options;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url)
    {
        \Schema::defaultStringLength(191);

        if (!Cache::has(settingsCacheName())) {
            if (file_exists(storage_path('installed'))) {
                Cache::remember(
                    settingsCacheName(),
                    now()->addDays(30),
                    function () {
                        $conf = [];
                        foreach (Options::select('value', 'config_key')->get()->toArray() as $setting) {
                            $conf[$setting['config_key']] = $setting['value'];
                        }
                        return $conf;
                    }
                );
            }
        }
        date_default_timezone_set(get_option('timezone', 'UTC'));

        if (env('REDIRECT_HTTPS', false)) {
            $url->forceScheme('https');
        }
        if (app()->environment('production')) {
            \DB::disableQueryLog();
        }
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        // if ($this->app->isLocal()) {
        //     $this->app->register(TelescopeServiceProvider::class);
        // }
    }
}
