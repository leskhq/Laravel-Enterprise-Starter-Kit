<?php namespace App\Repositories\Criteria\PurchaseOrder;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class PurchaseOrdersByCreatedAtDescending extends Criteria {

    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->orderBy('created_at', 'DESC');
        return $model;
    }

}
