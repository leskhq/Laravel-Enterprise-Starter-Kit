<?php namespace App\Models;

use App\Libraries\Str;
use App\Libraries\Utils;
use App\Traits\BaseModelTrait;
use Arcanedev\Settings\Facades\Setting as BaseSetting;
use Crypt;

class Setting extends BaseSetting
{
    use BaseModelTrait;

    protected $prefix = null;
    protected $delim  = '.';

    private static $ENCRYPTED_PREFIX = ":EnCrYpTeD:";

    public function __construct($keyPrefix = null, $delimiter  = '.')
    {
        $this->prefix = $keyPrefix;
        $this->delim = $delimiter;
    }


    private function underlyingGet($key, $defaultVal = null)
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

    public function set($key, $value = null, $encrypt = false)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

        if ($encrypt) {
            $value = $this->encrypt($value);
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

    public function get($key, $defaultVal = null)
    {
        $val = $this->underlyingGet($key, $defaultVal);

        if ( $this->isEncrypted($key, $val) ) {
            $val = $this->decrypt($val);
        }

        $val = Utils::correctType($val);
        return $val;
    }

    /**
     * @return mixed
     */
    public function save()
    {
        return parent::save();
    }

    /**
     * @param $val
     * @return bool
     */
    public function isEncrypted($key, $val = null)
    {
        if (Str::isNullOrEmptyString($val)) {
            $val = $this->underlyingGet($key);
        }

        if ( is_string($val) && Str::startsWith($val, self::$ENCRYPTED_PREFIX) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $val
     * @return string
     */
    public function decrypt($val)
    {
        return Crypt::decrypt(substr($val, strlen(self::$ENCRYPTED_PREFIX)));
    }

    /**
     * @param $value
     * @return string
     */
    public function encrypt($value)
    {
        return self::$ENCRYPTED_PREFIX . Crypt::encrypt($value);
    }
}
