<?php namespace App\Repositories\Criteria\Sale;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class SalesWithCustomers extends Criteria {


    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->with('customer');
        return $model;
    }

}
