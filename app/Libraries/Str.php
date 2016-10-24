<?php namespace App\Libraries;

use Illuminate\Support\Str as BaseStr;

class Str extends BaseStr
{

    /**
     * Returns the input string shrunk to the limit size, by cutting in the end (tail).
     * The start (head) of a string will be returned with an ellipsis after it
     * where the text is cut.

     * @param $value
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function head($value, $limit = 100, $end = '...')
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
    public static function tail($value, $limit = 100, $start = '...')
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
    public static function head_and_tail($value, $limit = 100, $mid = '...')
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
     * Evaluate the input string and returns true if it can be converted to a boolean.
     *
     * @param $str
     * @return bool
     */
    public static function isBoolean($str)
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
    public static function toBoolean($str)
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
     * Return true if the trim'ed value is unset, null or empty.
     *
     * Modification from: http://stackoverflow.com/a/381275
     * Author: Michael Haren (http://stackoverflow.com/users/29/michael-haren)
     *
     * @param $question
     * @return bool
     */
    public static function isNullOrEmptyString($question)
    {
        $isSet = isset($question);
        $isNull = is_null($question);
        $isString = is_string($question);

        if ($isSet && (!$isNull) && $isString) {
            $question = trim($question);
        }

        $isEmpty = empty($question);

        if ( (!$isSet) || ($isNull) || ($isEmpty) ) {
            return true;
        } else {
            return false;
        }
    }

}
