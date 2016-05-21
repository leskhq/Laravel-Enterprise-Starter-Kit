<?php namespace App\Repositories\Criteria\Material;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class MaterialsOutOfStock extends Criteria {

    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->where('stock', '<=', 'min_stock');
        return $model;
    }

}
