<?php namespace App\Traits;


trait BaseModelTrait
{

    /**
     * Confirm the proper type of the model, or find the instance of the model based
     * on the id or a column, which defaults to 'name'.
     *
     * @param $id
     * @return BaseModel|null
     */
    public static function resolve($id, $column = "name")
    {
        $modelObj = null;

        if ($id instanceof self) {
            $modelObj = $id;
        }
        elseif (is_numeric($id))
        {
            $modelObj = self::find($id);
        }
        else
        {
            $modelObj = self::where($column , '=', $id)->first();
        }

        return $modelObj;
    }


}
