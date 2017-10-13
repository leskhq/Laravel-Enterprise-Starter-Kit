<?php namespace App\Repositories\Criteria\Users;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UsersByUsernamesAscending implements CriteriaInterface {


    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        $model = $model->orderBy('username', 'ASC');
        return $model;
    }

}
