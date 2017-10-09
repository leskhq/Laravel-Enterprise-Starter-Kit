<?php namespace App\Repositories\Criteria\Permission;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PermissionsByNamesAscending implements CriteriaInterface {


    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        $model = $model->orderBy('name', 'ASC');
        return $model;
    }

}
