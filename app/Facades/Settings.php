<?php namespace App\Facades;

//use Arcanedev\LaravelSettings\Contracts\Manager;
use Illuminate\Support\Facades\Facade;

/**
 * Class     Settings
 *
 * @package  Arcanedev\LaravelSettings\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Settings extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'lesk.settings.manager'; }
}
