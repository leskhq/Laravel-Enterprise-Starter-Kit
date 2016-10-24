<?php namespace App\Libraries;

use Dotenv;
use Setting;

class SettingDotEnv extends Dotenv
{

    public static function load($path, $file = '.env')
    {
        $cnt = 0;
        $lines = null;

        if (!is_string($file)) {
            $file = '.env';
        }

        $filePath = rtrim($path, '/') . '/' . $file;
        if (!is_readable($filePath) || !is_file($filePath)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'File %s not found or not readable. ' .
                    'Create file with your environment settings at %s',
                    $file,
                    $filePath
                )
            );
        }

        // Read file into an array of lines with auto-detected line endings
        $autodetect = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', '1');
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        ini_set('auto_detect_line_endings', $autodetect);

        foreach ($lines as $line) {
            // Disregard comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            // Only use non-empty lines that look like setters
            if (strpos($line, '=') !== false) {
                $cnt = $cnt  + static::setSettingFromEnv($line);
            }
        }

        return $cnt;
    }

    public static function setSettingFromEnv($key, $value = null)
    {
        $cnt = 0;

        list($key, $value) = static::normaliseEnvironmentVariable($key, $value);

        // Filter out some Laravel system or dangerous environment variables
        // They all use the '_' as a word separator.
        $underPos = strpos($key, '_');
        if ($underPos > 0) {
            switch (substr($key, 0, $underPos)) {
                case "APP":
                case "DB":
                case "CACHE":
                case "MAIL":
                case "QUEUE":
                case "SESSION":
                    return $cnt;
            }
        }

        if (Setting::has($key)) {
            return $cnt;
        } else {
            Setting::set($key, $value);
            $cnt  = 1;
        }

        return $cnt;
    }

}
