<?php namespace App\Libraries;

use App\Libraries\Str;
use App\Repositories\AuditRepository as Audit;
use App\User;
use Auth;
use DateTime;
use DateTimeZone;
use Flash;
use Illuminate\Support\Arr;
use LERN;
use Setting;
use App\Exceptions\JsonEncodingMaxDepthException;
use App\Exceptions\JsonEncodingStateMismatchException;
use App\Exceptions\JsonEncodingSyntaxErrorException;
use App\Exceptions\JsonEncodingUnexpectedControlCharException;
use App\Exceptions\JsonEncodingUnknownException;

class Utils
{
    /**
     * Transform the input string into function 1, 2 or 3 parameters.
     * Used in Blade template to call the str_head, str_tail and
     * str_head_and_tail functions.
     *
     * @param $expression
     * @return array
     */
    public static function getParmsForStrHeadAndTails($expression)
    {
        $parms = self::splitBladeParameters($expression);
        $parmsCnt = count($parms);
        switch ($parmsCnt) {
            case 1:
                $value = $parms[0];
                $limit = 100;
                $end = '...';
                break;
            case 2:
                $value = $parms[0];
                $limit = $parms[1];
                $end = '...';
                break;
            case 3:
                $value = $parms[0];
                $limit = $parms[1];
                $end = $parms[2];
                $end = str_replace(['"', "'"], '', $end);
                break;
        }
        return array($value, $limit, $end);
    }


    /**
     * Iterate through the flattened array of settings and removes
     * all user settings. A new array is build and returned.
     *
     * User settings are found to start with the 'User" key followed by a number,
     * both parts are separated by a dot ('.').
     *
     * @param $allSettings
     * @return array
     */
    public static function FilterOutUserSettings($allSettings)
    {
        $allNonUserSetting = Arr::where($allSettings, function ($k) {
            if ("User." === substr( $k, 0, 5 ) ) {
                $kparts = explode('.', $k);
                $user = User::ofUsername($kparts[1])->first();
                if ($user instanceof User) {
                    return false;
                }
            }

            return true;
        });

        return $allNonUserSetting;
    }


    /**
     * Evaluate the input variable and if the string can be converted to either
     * a boolean, float or integer converts it and return that value.
     * Otherwise simply return the inout variable unchanged.
     *
     * @param $value The value to convert.
     * @return bool|float|int|misc
     */
    public static function correctType($value)
    {
        try {
            if (Str::isBoolean($value)) {
                $value = Str::toBoolean($value);
            } elseif (is_float($value)) {
                $value = floatval($value);
            } elseif (is_int($value)) {
                $value = intval($value);
            }
        } catch (\Exception $ex) {}

        return $value;
    }



    /**
     * Send flash message to the users screen and logs an audit log. If an exception is provided
     * the exception message will be included in the audit log entry.
     *
     * @param $auditCategory
     * @param $msg
     * @param $flashLevel
     * @param null $exception
     */
    public static function flashAndAudit($auditCategory, $msg, $flashLevel, $exception = null)
    {
        $auditMsg = $msg;

        // Get current user or set guest to true for unauthenticated users.
        if ( Auth::check() ) {
            $user       = Auth::user();

            if( (isset($exception)) && (strlen($exception->getMessage()) > 0) ) {
                $auditMsg = $msg . " Exception information: " . $exception->getMessage();
            }
            switch ($flashLevel) {
                case FlashLevel::INFO:
                    Flash::info($msg);
                    break;
                case FlashLevel::SUCCESS:
                    Flash::success($msg);
                    break;
                case FlashLevel::WARNING:
                    Flash::warning($msg);
                    break;
                // case FlashLevel::ERROR
                default:
                    Flash::error($msg);
                    break;

            }
            Audit::log( $user->id, $auditCategory, $auditMsg );
        }
    }

    /**
     * Process the parameter input from a blade directive and splits it
     * into an array of parameters.
     *
     * @param $expression
     * @return array
     */
    public static function splitBladeParameters($expression)
    {
        $expCleaned = str_replace(['(', ')', ' '], '', $expression);
        $parms = explode(',', $expCleaned);

        return $parms;
    }


    /**
     * @param $utcDate
     * @return string
     */
//    public static function convertToLocalDateTime($utcDate)
    public static function userTimeZone($date)
    {
        $time_zone = Utils::getUserOrAppOrDefaultSetting('time_zone', 'app.time_zone', 'UTC');
        $time_format = Utils::getUserOrAppOrDefaultSetting('time_format', 'app.time_format', '24');

        // Get the time zone abbreviation to display from the time zone identifier
        $dateTime = new DateTime();
        $dateTime->setTimeZone(new DateTimeZone($time_zone));
        $tzAbrev = $dateTime->format('T');
        // Convert system time to user's timezone
        $locDate = $date;
        $locDate->setTimeZone(new DateTimeZone($time_zone));

        if ("12" == $time_format) {
            $finalSTR = $locDate->format('Y-m-d g:i A') . " " . $tzAbrev; // output: 2011-04-26 8:45 PM EST
        } else {
            $finalSTR = $locDate->format('Y-m-d H:i') . " " . $tzAbrev; // output: 2011-04-26 20:45 EST
        }

        return $finalSTR;
    }


    /**
     * @return mixed|null
     */
    public static function getUserOrAppOrDefaultSetting($userKey, $appKey = null, $default = null)
    {
        $setting = null;

        if (null == $appKey) {
            $appKey = $userKey;
        }

        if (\Auth::check()) {
            $user = \Auth::user();
            $setting = $user->settings()->get($userKey);
        }
        if (null == $setting) {
            $setting = Setting::get($appKey, $default);
        }
        return $setting;
    }


    public static function formatClass($class)
    {
        $parts = explode('\\', $class);

        return sprintf('<abbr title="%s">%s</abbr>', $class, array_pop($parts));
    }

    public static function formatPath($path, $line)
    {
        $path = self::escapeHtml($path);
        $file = preg_match('#[^/\\\\]*$#', $path, $file) ? $file[0] : $path;

        $fileLinkFormat = ini_get('xdebug.file_link_format') ?: get_cfg_var('xdebug.file_link_format');

        if ($linkFormat = $fileLinkFormat) {
            $link = strtr(self::escapeHtml($linkFormat), array('%f' => $path, '%l' => (int) $line));

            return sprintf(' in <a href="%s" title="Go to source">%s line %d</a>', $link, $file, $line);
        }

        return sprintf(' in <a title="%s line %3$d" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;">%s line %d</a>', $path, $file, $line);
    }

    /**
     * HTML-encodes a string.
     */
    public static function escapeHtml($str)
    {
        $charset = ini_get('default_charset') ?: 'UTF-8';
        return htmlspecialchars($str, ENT_QUOTES | (PHP_VERSION_ID >= 50400 ? ENT_SUBSTITUTE : 0), $charset);
    }


    /**
     * Safe JSON_ENCODE function that tries to deal with UTF8 chars or throws a valid exception.
     *
     * Lifted from http://stackoverflow.com/questions/10199017/how-to-solve-json-error-utf8-error-in-php-json-decode
     * Based on: http://php.net/manual/en/function.json-last-error.php#115980
     * @param $value
     * @return string
     */
    public static function safe_json_encode($value){
        if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            $encoded = json_encode($value, JSON_PRETTY_PRINT);
        } else {
            $encoded = json_encode($value);
        }
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $encoded;
            case JSON_ERROR_DEPTH:
                throw new JsonEncodingMaxDepthException('Maximum stack depth exceeded');
            case JSON_ERROR_STATE_MISMATCH:
                throw new JsonEncodingStateMismatchException('Underflow or the modes mismatch');
            case JSON_ERROR_CTRL_CHAR:
                throw new JsonEncodingUnexpectedControlCharException('Unexpected control character found');
            case JSON_ERROR_SYNTAX:
                throw new JsonEncodingSyntaxErrorException('Syntax error, malformed JSON');
            case JSON_ERROR_UTF8:
                $clean = self::utf8ize($value);
                return self::safe_json_encode($clean);
            default:
                throw new JsonEncodingUnknownException('Unknown error');

        }
    }

    /**
     * Clean the array passed in from UTF8 chars.
     *
     * Lifted from http://stackoverflow.com/questions/10199017/how-to-solve-json-error-utf8-error-in-php-json-decode
     * Based on: http://php.net/manual/en/function.json-last-error.php#115980
     *
     * @param $mixed
     * @return array|string
     */
    public static function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = self::utf8ize($value);
            }
        } else if (is_string ($mixed)) {
            return utf8_encode($mixed);
        }
        return $mixed;
    }

}
