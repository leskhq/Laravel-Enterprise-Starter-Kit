<?php namespace App\Repositories\Criteria\Product;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ProductWhereCategoryLike extends Criteria {

    private $int;

    public function __construct($int)
    {
        $this->int = $int;
    }

    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->where('category', 'like', $this->int);
        return $model;
    }

}
