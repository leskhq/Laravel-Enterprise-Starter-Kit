<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Route;

/**
 * Class RouteTransformer
 * @package namespace App\Transformers;
 */
class RouteTransformer extends TransformerAbstract
{

    /**
     * Transform the \Route entity
     * @param \Route $model
     *
     * @return array
     */
    public function transform(Route $model)
    {
        return [
            'id'            => (int) $model->id,

            /* place your other model properties here */
            'name'          => $model->name,
            'method'        => $model->method,
            'path'          => $model->path,
            'action_name'   => $model->action_name,
            'permission_id' => (int) $model->permission_id,
            'enabled'       => $model->enabled,

            'created_at'    => $model->created_at,
            'updated_at'    => $model->updated_at
        ];
    }
}
