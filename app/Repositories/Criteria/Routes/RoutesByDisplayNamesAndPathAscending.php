<?php namespace App\Repositories\Criteria\Routes;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class RoutesByDisplayNamesAndPathAscending implements CriteriaInterface {


    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        $model = $model->orderBy('name', 'ASC')
            ->orderBy('path', 'ASC');
        return $model;
    }

}
