<?php

namespace App\Providers;

use App\Libraries\Utils;
use Blade;
use Illuminate\Support\ServiceProvider;

class CustomBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bladeDirectives();
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
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        Blade::directive('strHead', function($expression){

            list($value, $limit, $end) = Utils::getParmsForStrHeadAndTails($expression);

            return "<?php echo e(App\Libraries\Str::head({$value}, {$limit}, '{$end}')); ?>";
        });

        Blade::directive('strTail', function($expression){

            list($value, $limit, $end) = Utils::getParmsForStrHeadAndTails($expression);

            return "<?php echo e(App\Libraries\Str::tail({$value}, {$limit}, '{$end}')); ?>";
        });

        Blade::directive('strHeadAndTail', function($expression){

            list($value, $limit, $end) = Utils::getParmsForStrHeadAndTails($expression);

            return "<?php echo e(App\Libraries\Str::head_and_tail({$value}, {$limit}, '{$end}')); ?>";
        });

        Blade::directive('userTimeZone', function($expression){

            $parms = Utils::splitBladeParameters($expression, true);
            $dateCode = $parms[0];

            return "<?php echo e(App\Libraries\Utils::userTimeZone({$dateCode})); ?>";
        });

    }


}
