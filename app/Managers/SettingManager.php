<?php namespace App\Managers;

/**
 * @license GPLv3
 * @package Sroutier\MenuBuilder
 */

use App\Models\Setting as SettingModel;
use Illuminate\Foundation\Application;

class SettingManager
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function load($envName)
    {
        return (new SettingModel())->load($envName);
    }

    public function clear()
    {
        return (new SettingModel())->clear();
    }

    /**
     * @param $key
     * @return mixed
     */
    public function has($key)
    {
        return (new SettingModel())->has($key);
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function forget($key = null)
    {
        return (new SettingModel())->forget($key);
    }

    /**
     * @param $key
     * @param null $defaultVal
     * @return \App\Libraries\misc|bool|float|int|mixed|null
     */
    public function get($key, $defaultVal = null)
    {
        return (new SettingModel())->get($key, $defaultVal);
    }

    /**
     * @param $key
     * @param null $value
     * @return mixed
     */
    public function set($key, $value = null, $encrypt = false)
    {
        return (new SettingModel())->set($key, $value, $encrypt);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return (new SettingModel())->all();
    }

    /**
     * @return mixed
     */
    public function save()
    {
        return (new SettingModel())->save();
    }

    /**
     * @param $key
     * @param null $val
     * @return bool
     */
    public function isEncrypted($key, $val = null)
    {
        return (new SettingModel())->isEncrypted($key, $val);
    }
}
