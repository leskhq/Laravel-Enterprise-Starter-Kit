<?php namespace App\Libraries;

use App\Repositories\AuditRepository as Audit;
use Auth;
use Flash;
use Illuminate\Support\Arr;

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
        $parms = str_replace(['(', ')', ' '], '', $expression);
        $parmsCnt = substr_count($parms, ',') + 1;
        switch ($parmsCnt) {
            case 1:
                $value = $parms;
                $limit = 100;
                $end = '...';
                break;
            case 2:
                list($value, $limit) = explode(',', $parms);
                $end = '...';
                break;
            case 3:
                list($value, $limit, $end) = explode(',', $parms);
                $end = str_replace(['"', "'"], '', $end);
                break;
        }
        return array($value, $limit, $end);
    }


    /**
     * Returns the input string shrunk to the limit size, by cutting in the end (tail).
     * The start (head) of a string will be returned with an ellipsis after it
     * where the text is cut.

     * @param $value
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function str_head($value, $limit = 100, $end = '...')
    {
        $value_len = strlen($value);
        $end_len = strlen($end);
        $head_end = $limit - $end_len;

        if ($limit >= $value_len)
            return $value;
        else
            return substr($value, 0, $head_end) . $end;
    }


    /**
     * Returns the input string shrunk to the limit size, by cutting in the start (head).
     * The end (tail) of a string will be returned with an ellipsis before it
     * where the text is cut.
     *
     * @param $value
     * @param int $limit
     * @param string $start
     * @return string
     */
    public static function str_tail($value, $limit = 100, $start = '...')
    {
        $value_len = strlen($value);
        $start_len = strlen($start);

        if ($limit >= $value_len)
            return $value;
        else
            $tail_start = $value_len - $limit + $start_len;

        return $start . substr($value, $tail_start);
    }


    /**
     * Returns the input string shrunk to the limit size, by cutting in the middle.
     * The start (head) and end (tail) of a string will be returned with an ellipsis between them
     * where the text is cut.
     *
     * @param $value
     * @param int $limit
     * @param string $mid
     * @return string
     */
    public static function str_head_and_tail($value, $limit = 100, $mid = '...')
    {
        $value_len = strlen($value);
        $mid_len = strlen($mid);
        $chunk_len = ($limit - $mid_len ) / 2;
        $tail_start = $value_len - $chunk_len;

        if ($limit >= $value_len)
            return $value;
        else {
            $head = substr($value, 0, $chunk_len);
            $tail = substr($value, $tail_start);
            return $head . $mid . $tail;
        }
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
                if (is_numeric($kparts[1])) {
                    return false;
                }
            }

            return true;
        });

        return $allNonUserSetting;
    }


    /**
     * Evaluate the input string and returns true if it can be converted to a boolean.
     *
     * @param $str
     * @return bool
     */
    public static function strIsBoolean($str)
    {
        if (is_string($str)) {
            switch (strtolower($str)) {
                case '1':
                case 'true':
                case 'on':
                case 'yes':
                case 'y':
                    return true;
                case '0':
                case 'false':
                case 'off':
                case 'no':
                case 'n':
                    return true;
            }
        } else {
            return false;
        }
    }


    /**
     * Converts the input string to it's boolean representation.
     *
     * @param $str
     * @return bool
     */
    public static function strToBoolean($str)
    {
        switch (strtolower($str)) {
            case '1':
            case 'true':
            case 'on':
            case 'yes':
            case 'y':
                return true;
            case '0':
            case 'false':
            case 'off':
            case 'no':
            case 'n':
                return false;
        }
    }


    /**
     * Evaluate the input variable and if the string can be converted to either
     * a boolean, float or integer converts it and return that value.
     * Otherwise simply return the inout variable unchanged.
     *
     * @param $value
     * @return bool|float|int|misc
     */
    public static function correctType($value)
    {
        try {
            if (static::strIsBoolean($value)) {
                $value = static::strToBoolean($value);
            } elseif (is_float($value)) {
                $value = floatval($value);
            } elseif (is_int($value)) {
                $value = intval($value);
            }
        } catch (Exception $ex) {}

        return $value;
    }



    /**
     * @param $auditCategory
     * @param $msg
     * @param $flashLevel
     * @param null $exception
     */
    public static function flashAndAudit($auditCategory, $msg, $flashLevel = FlashLevel::SUCCESS, $exception = null)
    {
        // Get current user or set guest to true for unauthenticated users.
        if ( Auth::check() ) {
            $user       = Auth::user();

            if( (isset($exception)) && (strlen($exception->getMessage()) > 0) ) {
                $msg = $msg . " Exception information: " . $exception->getMessage();
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
                //            case FlashLevel::ERROR:
                default:
                    Flash::error($msg);
                    break;

            }
            Audit::log( $user->id, $auditCategory, $msg );
        }
    }



}
