<?php namespace App\Models;


use App\Libraries\Str;
use App\Managers\LeskSettingsManager;
use Illuminate\Foundation\Application;

class UserSetting extends LeskSettingsManager
{
    protected $user;

    public function __construct(Application $app, User $user)
    {
        $this->user = $user;
        parent::__construct($app);
    }

    public function prefix()
    {
        return "User." . $this->user->username;
    }

    public function getUserKey($key)
    {
        return $this->prefix() . '.' . $key;
    }

    public function get($key, $defaultVal = null)
    {
        $setting = null;

        $userKey = $this->getUserKey($key);
        $setting = parent::get($userKey);

        if (Str::isNullOrEmptyString($setting)) {
            $setting = parent::get($key, $defaultVal);
        }

        return $setting;
    }

    public function has($key)
    {
        $userKey = $this->getUserKey($key);
        return parent::has($userKey);
    }

    public function set($key, $value = null, $encrypt = false)
    {
        $userKey = $this->getUserKey($key);

        if ($encrypt) {
            $value = $this->encrypt($value);
        }

        $ret = parent::set($userKey, $value);
        $this->save();

        return $ret;
    }

    public function forget($key = null)
    {
        $userkey = $this->getUserKey($key);

        $ret = parent::forget($userkey);
        $this->save();

        return $ret;
    }


    public function all()
    {
        $allUserKeys = null;

        $userPrefix = $this->prefix();
        $allUserKeys = parent::get($userPrefix);

        return $allUserKeys;
    }

}