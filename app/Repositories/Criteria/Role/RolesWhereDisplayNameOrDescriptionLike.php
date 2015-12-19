<?php namespace App\Repositories\Criteria\Role;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class RolesWhereDisplayNameOrDescriptionLike extends Criteria {

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
        $model = $model->where('display_name', 'like', $this->str)
                     ->orWhere('description', 'like', $this->str);
        return $model;
    }

}
