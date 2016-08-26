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
}
