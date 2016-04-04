<?php namespace App\Repositories\Criteria\Product;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ProductOrderByColumn extends Criteria {

    private $sortBy;

    private $orderBy;

    public function __construct($sortBy, $orderBy)
    {
        $this->sortBy = $sortBy;
        $this->orderBy = $orderBy;
    }

    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->orderBy($this->sortBy, $this->orderBy);
        return $model;
    }

}
