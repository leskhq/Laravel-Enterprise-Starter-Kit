<?php namespace App\Repositories\Criteria\Role;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class RolesWhereDisplayNameOrDescriptionLike implements CriteriaInterface {

    private $str;


    public function __construct($str)
    {
        $this->str = '%'.$str.'%';
    }

    /**
     * @param $model
     */
    public function apply( $model, RepositoryInterface $repository )
    {
        $model = $model->where(  'display_name', 'like', $this->str)
                       ->orWhere('description',  'like', $this->str);
        return $model;
    }

}
