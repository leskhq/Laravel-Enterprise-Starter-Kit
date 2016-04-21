<?php namespace App\Repositories\Criteria\Sale;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class SalesOrderBefore extends Criteria {

    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->where('transfer_date', '<=', $this->date);
        return $model;
    }

}
