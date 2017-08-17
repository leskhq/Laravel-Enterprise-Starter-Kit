<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

/**
 * Class UserTransformer
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'            => (int) $model->id,

            /* place your other model properties here */
            'first_name'    => $model->first_name,
            'last_name'     => $model->last_name,
            'username'      => $model->username,
            'email'         => $model->email,
            'enabled'       => $model->enabled,
            'auth_type'     => $model->auth_type,

            'created_at'    => $model->created_at,
            'updated_at'    => $model->updated_at
        ];
    }
}
