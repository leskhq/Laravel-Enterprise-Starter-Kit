<?php namespace App\Models;

use App\Exceptions\InvalidUserException;
use App\Traits\BaseModelTrait;
use App\User;

class UserSetting extends Setting
{
    use BaseModelTrait;

    public static function get($key, $default = null, User $user = null)
    {
        $userKey = static::getUserSettingKey($user, $key);
        return parent::get($userKey, $default);
    }

    public static function has($key, User $user = null)
    {
        $userKey = static::getUserSettingKey($user, $key);
        return parent::has($userKey);
    }

    public static function set($key, $value = null, User $user = null)
    {
        $userKey = static::getUserSettingKey($user, $key);
        return parent::set($userKey, $value);
    }

    public static function forget($key, User $user = null)
    {
        $userKey = static::getUserSettingKey($user, $key);
        return parent::forget($userKey);
    }

    public static function all(User $user = null)
    {
        $userKey = static::getUserSettingKey($user);
        return parent::get($userKey);
    }

    public static function reset(User $user = null)
    {
        $userKey = static::getUserSettingKey($user);
        return parent::forget($userKey);
    }

    /**
     * Helper function to build the setting key for the user based
     * on the User parent key and the user's id number.
     *
     * @param User $user
     * @param $key
     * @return string
     * @throws InvalidUserException
     */
    private static function getUserSettingKey(User $user = null, $key = null)
    {
        $userKey = null;
        $userSettingGroup = null;

        if ( (null == $user) && (\Auth::check()) ) {
            $user = \Auth::user();
            $userSettingGroup = 'User.'.$user->id;
            if (null != $key) {
                $userKey = $userSettingGroup.'.'.$key;
            }
            else {
                $userKey = $userSettingGroup;
            }
        } else {
            throw new InvalidUserException("No user logged in or no user object passed in.");
        }

        return $userKey;
    }


}
