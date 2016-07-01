<?php namespace App\Libraries;

class Utils {



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

}
