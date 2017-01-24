<?php namespace App\Libraries;


use InvalidArgumentException;

class FlashLevel
{
    const INFO = 200;

    const SUCCESS = 250;

    const WARNING = 300;

    const ERROR = 400;

    /**
     * Flash levels
     *
     * @var array $levels Flash levels
     */
    protected static $levels = array(
        200 => 'INFO',
        250 => 'SUCCESS',
        300 => 'WARNING',
        400 => 'ERROR',
    );

    /**
     * Gets all supported flash levels.
     *
     * @return array Assoc array with human-readable level names => level codes.
     */
    public static function getLevels()
    {
        return array_flip(static::$levels);
    }

    /**
     * Gets the name of the flash level.
     *
     * @param  integer $level
     * @return string
     */
    public static function getLevelName($level)
    {
        if (!isset(static::$levels[$level])) {
            throw new InvalidArgumentException('Level "'.$level.'" is not defined, use one of: '.implode(', ', array_keys(static::$levels)));
        }

        return static::$levels[$level];
    }

}
