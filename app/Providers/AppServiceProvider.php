<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Utils;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('strHead', function($expression){

            list($value, $limit, $end) = Utils::getParmsForStrHeadAndTails($expression);

            return "<?php echo e(App\Libraries\Utils::str_head({$value}, {$limit}, '{$end}')); ?>";
        });

        Blade::directive('strTail', function($expression){

            list($value, $limit, $end) = Utils::getParmsForStrHeadAndTails($expression);

            return "<?php echo e(App\Libraries\Utils::str_tail({$value}, {$limit}, '{$end}')); ?>";
        });

        Blade::directive('strHeadAndTail', function($expression){

            list($value, $limit, $end) = Utils::getParmsForStrHeadAndTails($expression);

            return "<?php echo e(App\Libraries\Utils::str_head_and_tail({$value}, {$limit}, '{$end}')); ?>";
        });



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Manually registering provider only if the environment is set to
        // development. That prevents a loading failure in PROD when the
        // package is not present.
        if ($this->app->environment('development')) {
//            $this->app->register('JeroenG\Packager\PackagerServiceProvider');
            $this->app->register('Libern\SqlLogging\SqlLoggingServiceProvider');
        }
    }
}
