<?php namespace App\Repositories\Criteria\PurchaseOrder;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class PurchaseOrdersWhereStatus extends Criteria {
    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->where('status', 'like', 4);
        return $model;
    }

}
