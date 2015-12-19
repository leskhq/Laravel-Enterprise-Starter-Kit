<?php namespace App\Repositories\Criteria\User;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class UsersWhereFirstNameOrLastNameOrUsernameLike extends Criteria {

    private $str;


    public function __construct($str)
    {
        $this->str = '%'.$str.'%';
    }

    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->where('first_name', 'like', $this->str)
                     ->orWhere('last_name', 'like', $this->str)
                     ->orWhere('username', 'like', $this->str);
        return $model;
    }

}
