<?php namespace App\Repositories\Criteria\Permission;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PermissionsByDisplayNamesAscending implements CriteriaInterface {


    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        $model = $model->orderBy('display_name', 'ASC');
        return $model;
    }

}
