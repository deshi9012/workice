<?php

namespace App\Providers;

use App\Services\Gravatar;
use App\Services\TagService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laravel\Cashier\Cashier;
use Parsedown;

/**
 * Class ParsedownServiceProvider
 *
 * @package App\Providers
 */
class CustomBladeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        Blade::directive(
            'parsedown',
            function ($expression) {
                return "<?php echo parsedown($expression); ?>";
            }
        );
        Blade::directive(
            'langapp',
            function ($expression) {
                return "<?php echo trans('app.'.${expression}); ?>";
            }
        );
        Blade::directive(
            'langactivity',
            function ($expression) {
                return "<?php echo trans('activity.'.${expression}); ?>";
            }
        );
        Blade::directive(
            'langinstall',
            function ($expression) {
                return "<?php echo trans('install.'.${expression}); ?>";
            }
        );
        Blade::directive(
            'langmail',
            function ($expression) {
                return "<?php echo trans('mail.'.${expression}); ?>";
            }
        );
        Blade::if(
            'admin',
            function () {
                return isAdmin();
            }
        );
        Blade::directive(
            'currency',
            function ($expression) {
                return "<?php echo currency(${expression}); ?>";
            }
        );
        Blade::directive(
            'metrics',
            function ($expression) {
                return "<?php echo metrics(${expression}); ?>";
            }
        );
        Blade::directive('modactive', function ($expression) {
            return "<?php if (moduleActive($expression)) { ?>";
        });
        Blade::directive('endmod', function () {
            return "<?php } ?>";
        });

        \Blade::directive(
            'emojione',
            function ($expression) {
                return "<?php echo \App::make('emojione')->toImage($expression); ?>";
            }
        );
        Blade::directive(
            'required',
            function ($expression) {
                return '<span class="text-danger">*</span>';
            }
        );
        Blade::directive(
            'render',
            function ($component) {
                return "<?php echo (app($component))->toHtml(); ?>";
            }
        );
        Cashier::useCurrency(config('system.cashier.currency'), config('system.cashier.symbol'));
    }

    /**
     * @return BladeCompiler
     */
    protected function compiler()
    {
        return app('view')->getEngineResolver()->resolve('blade')->getCompiler();
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'parsedown',
            function () {
                return Parsedown::instance()->setBreaksEnabled(true);
            }
        );
        $this->app->singleton(TagService::class);
        $this->app->singleton(
            'gravatar',
            function () {
                return new Gravatar;
            }
        );
    }
}
