<?php namespace App\Models;

use App\Libraries\Str;
use App\Libraries\Utils;
use App\Traits\BaseModelTrait;
use Arcanedev\Settings\Facades\Setting as BaseSetting;

class Setting extends BaseSetting
{
    use BaseModelTrait;

    protected $prefix = null;
    protected $delim  = '.';

    public function __construct($keyPrefix = null, $delimiter  = '.')
    {
        $this->prefix = $keyPrefix;
        $this->delim = $delimiter;
    }


    public function get($key, $defaultVal = null)
    {
        $val = null;

        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

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


    public function has($key)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

        return parent::has($key);
    }

    public function set($key, $value = null)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

        return parent::set($key, $value);
    }


    public function forget($key = null)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            if (!Str::isNullOrEmptyString($key)) {
                $key = $this->prefix . $this->delim . $key;
            } else {
                $key = $this->prefix;
            }
        }

        return parent::forget($key);
    }


    public function all()
    {
        return parent::all();
    }

    public function getTyped($key, $defaultVal = null)
    {
        $val = $this->get($key, $defaultVal);
        $val = Utils::correctType($val);
        return $val;
    }


}
