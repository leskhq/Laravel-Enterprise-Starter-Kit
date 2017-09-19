<?php namespace App\Libraries;

use Illuminate\Support\Arr as BaseArr;

class Arr extends BaseArr
{

    /**
     * Transforms an indexed array to an associative array by duplicating the values as keys.
     * Optionally will capitalize the values for presentation.
     *
     * @param array $array
     * @param bool $capitalizeValues
     * @return array
     */
    public static function indexToAssoc(array $array, $capitalizeValues = false)
    {
        $keys = array_values($array);
        $values = array_values($array);
        if ($capitalizeValues) {
            foreach ($array as &$value) {
                $value = ucfirst($value);
            }
        }

        return array_combine($keys, $values);
    }

    /**
     * Remove the values provided from the array.
     * Values can be a single value or an array of values.
     *
     * @param array $array
     * @param array|string $values
     * @return array
     */
    public static function remove_value(array $array, $values)
    {
        $values = is_array($values) ? $values : [$values];

        foreach($values as $val) {
            if(($key = array_search($val, $array)) !== false) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
