<?php namespace App\Repositories\Criteria\Roles;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class RolesByDisplayNamesAscending implements CriteriaInterface {


    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        $model = $model->orderBy('display_name', 'ASC');
        return $model;
    }

}
