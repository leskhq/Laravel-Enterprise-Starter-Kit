<?php namespace App\Repositories\Criteria\Outlet;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class OutletSalesWithOutlets extends Criteria
{
    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->with('outlet');
        return $model;
    }

}
