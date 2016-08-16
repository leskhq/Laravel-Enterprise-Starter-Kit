<?php namespace App\Models;

use Arcanedev\Settings\Facades\Setting as BaseSetting;
use App\Libraries\Utils;

class Setting extends BaseSetting
{

    public static function get($key, $defaultVal = null)
    {
        $val = null;

        // Try to get value from settings
        $val = parent::get($key);
        // If val is null, try to get value from config or environment.
        if (null === $val) {
            $envKey = strtoupper($key);
            $val = Config( $key, env($envKey) );
        }
        // Finally if val is still null, assign the default value.
        if (null == $val) {
            $val = $defaultVal;
        }

        return $val;
    }


    public static function getTyped($key, $defaultVal = null)
    {
        $val = static::get($key, $defaultVal);
        $val = Utils::correctType($val);
        return $val;
    }


}
