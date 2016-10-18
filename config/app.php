<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG'),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP.URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => env('APP.TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Time format
    |--------------------------------------------------------------------------
    |
    | Should the time be displayed in 12 hour or 24 hour format?.
    | Defaults to 24 hour format.
    |
    */

    'time_format' => env('APP.TIME_FORMAT', '24'),



    /*
    |--------------------------------------------------------------------------
    | Supported locale
    |--------------------------------------------------------------------------
    |
    | List of supported locale for the application. Uncomment and add entries
    | as needed.
    |
    */

    'supportedLocales' => [
        'en'          => 'English',
//        'en-AU'       => 'Australian English',
//        'en-GB'       => 'British English',
//        'en-US'       => 'U.S. English',
        'es'          => 'español',
        'fr'          => 'français',
//        'fr-CA'       => 'français canadien',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => env('APP.LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => env('APP.FALLBACK_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY', 'SomeRandomString'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => 'single',

    /*
    |--------------------------------------------------------------------------
    | Permission and User relationship table
    |--------------------------------------------------------------------------
    |
    | This is the permission_user table used to save relationship
    | between permissions and users to the database.
    |
    | See: 'config/entrust.php'
    |
    */

    'permission_user_table' => 'permission_user',

    /*
    |--------------------------------------------------------------------------
    | Home route name
    |--------------------------------------------------------------------------
    |
    | The name of the route that requests will be redirected to when calling
    | the 'home' or '/' route.
    | This setting defaults to the 'welcome' route and it will be checked against
    | the users permission before redirecting, if the user does not have the
    | permission required to see the configured home route, the 'welcome'
    | route will be selected.
    |
    */
    'home_route' => env('APP.HOME_ROUTE', 'welcome'),

    /*
    |--------------------------------------------------------------------------
    | Long name
    |--------------------------------------------------------------------------
    |
    | The long name for the application displayed on the main menu bar on the
    | left when it is sized wide.
    |
    | NOTE: The long name supports HTML markup for styling.
    */
    'long_name' => env('APP.LONG_NAME', '<b>Laravel 5.1 </b>ESK'),

    /*
    |--------------------------------------------------------------------------
    | Short name
    |--------------------------------------------------------------------------
    |
    | The short name for the application, display in the tab or Web browser title
    | and on the main menu bar on the left when it is sized to a small.
    |
    | NOTE: The short name does not support any HTML markup.
    */
    'short_name' => env('APP.SHORT_NAME', 'LESK'),

    /*
    |--------------------------------------------------------------------------
    | Tag line
    |--------------------------------------------------------------------------
    |
    | The tag line appears at the bottom of every page on the right and can be
    | anything you want.
    |
    | NOTE: The tag line supports HTML markup for styling.
    */
    'tag_line' => env('APP.TAG_LINE', 'Anything you want'),

    /*
    |--------------------------------------------------------------------------
    | Copyright line
    |--------------------------------------------------------------------------
    |
    | The copyright line appear at the bottom of every page on the left and is
    | a convenient place to show a copyright notice, but it can also be
    | anything that you want.
    |
    | NOTE: The tag line supports HTML markup for styling.
    */
    'copyright_line' => env('APP.COPYRIGHT', '<strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.'),

    /*
    |--------------------------------------------------------------------------
    | Allow registration
    |--------------------------------------------------------------------------
    |
    | Boolean flag that allows users to register themselves, defaults to true.
    |
    */
    'allow_registration' => env('APP.ALLOW_REGISTRATION', true),

    /*
    |--------------------------------------------------------------------------
    | Context help area
    |--------------------------------------------------------------------------
    |
    | Boolean flag that shows the context help area if present, defaults to true.
    |
    */
    'context_help_area' => env('APP.CONTEXT_HELP_AREA', true),

    /*
    |--------------------------------------------------------------------------
    | Search box
    |--------------------------------------------------------------------------
    |
    | Boolean flag that shows the Search box, defaults to true.
    |
    */
    'search_box' => env('APP.SEARCH_BOX', true),

    /*
    |--------------------------------------------------------------------------
    | Notification area
    |--------------------------------------------------------------------------
    |
    | Boolean flag that shows the notification area boilerplate, defaults to true.
    |
    */
    'notification_area' => env('APP.NOTIFICATION_AREA', true),

    /*
    |--------------------------------------------------------------------------
    | Extended user menu
    |--------------------------------------------------------------------------
    |
    | Boolean flag that shows extended user menu boilerplate, defaults to true.
    |
    */
    'extended_user_menu' => env('APP.EXTENDED_USER_MENU', true),

    /*
    |--------------------------------------------------------------------------
    | User profile link
    |--------------------------------------------------------------------------
    |
    | Boolean flag that shows the user profile link boilerplate, defaults to true.
    |
    */
    'user_profile_link' => env('APP.USER_PROFILE_LINK', true),

    /*
    |--------------------------------------------------------------------------
    | Right sidebar
    |--------------------------------------------------------------------------
    |
    | Boolean flag that shows the right sidebar area boilerplate, defaults to true.
    |
    */
    'right_sidebar' => env('APP.RIGHT_SIDEBAR', true),

    /*
    |--------------------------------------------------------------------------
    | Email notifications
    |--------------------------------------------------------------------------
    |
    | Boolean flag that enables email notifications, defaults to false.
    |
    */
    'email_notifications' => env('APP.EMAIL_NOTIFICATIONS_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */
    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Routing\ControllerServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
//        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\MenuBuilderServiceProvider::class,
        App\Providers\CustomBladeServiceProvider::class,

        Sroutier\EloquentLDAP\Providers\EloquentLDAPServiceProvider::class,

        Barryvdh\Debugbar\ServiceProvider::class,
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,
        Laracasts\Flash\FlashServiceProvider::class,
        YAAP\Theme\ThemeServiceProvider::class,
        Zizaco\Entrust\EntrustServiceProvider::class,
//        Zofe\Rapyd\RapydServiceProvider::class,
        Baum\Providers\BaumServiceProvider::class,
        Sroutier\LESKModules\ModulesServiceProvider::class,
        Mgallegos\LaravelJqgrid\LaravelJqgridServiceProvider::class,
        Creativeorange\Gravatar\GravatarServiceProvider::class,
        Tylercd100\LERN\LERNServiceProvider::class,
        Arcanedev\Settings\SettingsServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        'Auth'      => Illuminate\Support\Facades\Auth::class,
        'Blade'     => Illuminate\Support\Facades\Blade::class,
        'Bus'       => Illuminate\Support\Facades\Bus::class,
        'Cache'     => Illuminate\Support\Facades\Cache::class,
        'Config'    => Illuminate\Support\Facades\Config::class,
        'Cookie'    => Illuminate\Support\Facades\Cookie::class,
        'Crypt'     => Illuminate\Support\Facades\Crypt::class,
        'DB'        => Illuminate\Support\Facades\DB::class,
        'Eloquent'  => Illuminate\Database\Eloquent\Model::class,
        'Event'     => Illuminate\Support\Facades\Event::class,
        'File'      => Illuminate\Support\Facades\File::class,
        'Hash'      => Illuminate\Support\Facades\Hash::class,
        'Input'     => Illuminate\Support\Facades\Input::class,
        'Inspiring' => Illuminate\Foundation\Inspiring::class,
        'Lang'      => Illuminate\Support\Facades\Lang::class,
        'Log'       => Illuminate\Support\Facades\Log::class,
        'Mail'      => Illuminate\Support\Facades\Mail::class,
        'Password'  => Illuminate\Support\Facades\Password::class,
        'Queue'     => Illuminate\Support\Facades\Queue::class,
        'Redirect'  => Illuminate\Support\Facades\Redirect::class,
        'Redis'     => Illuminate\Support\Facades\Redis::class,
        'Request'   => Illuminate\Support\Facades\Request::class,
        'Response'  => Illuminate\Support\Facades\Response::class,
        'Route'     => Illuminate\Support\Facades\Route::class,
        'Schema'    => Illuminate\Support\Facades\Schema::class,
        'Session'   => Illuminate\Support\Facades\Session::class,
        'Storage'   => Illuminate\Support\Facades\Storage::class,
        'URL'       => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View'      => Illuminate\Support\Facades\View::class,

        'Form'        => Collective\Html\FormFacade::class,
        'Html'        => Collective\Html\HtmlFacade::class,
        'Debugbar'    => Barryvdh\Debugbar\Facade::class,
        'Flash'       => Laracasts\Flash\Flash::class,
        'Theme'       => YAAP\Theme\Facades\Theme::class,
        'Entrust'     => Zizaco\Entrust\EntrustFacade::class,
        'MenuBuilder' => App\Facades\MenuBuilderFacade::class,
        'Module'      => Sroutier\LESKModules\Facades\Module::class,
        'GridRender'  => Mgallegos\LaravelJqgrid\Facades\GridRender::class,
        'GridEncoder' => Mgallegos\LaravelJqgrid\Facades\GridEncoder::class,
        'Gravatar'    => Creativeorange\Gravatar\Facades\Gravatar::class,
        'LERN'        => Tylercd100\LERN\Facades\LERN::class,
        // Commented out to force the usage of the Setting model located at app/Models/Setting.php
//        'Setting'     => Arcanedev\Settings\Facades\Setting::class,

    ],

];
