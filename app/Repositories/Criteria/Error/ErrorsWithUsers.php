<?php namespace App\Repositories\Criteria\Error;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ErrorsWithUsers extends Criteria {


    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->with('user');
        return $model;
    }

}
