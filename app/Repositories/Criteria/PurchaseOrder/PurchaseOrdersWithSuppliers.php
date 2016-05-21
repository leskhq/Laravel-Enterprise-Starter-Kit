<?php namespace App\Repositories\Criteria\PurchaseOrder;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class PurchaseOrdersWithSuppliers extends Criteria {
    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->with('supplier');
        return $model;
    }

}
