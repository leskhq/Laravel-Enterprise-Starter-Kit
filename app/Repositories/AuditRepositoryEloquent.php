<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AuditRepository;
use App\Models\Audit;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AuditRepositoryEloquent extends BaseRepository implements AuditRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Audit::class;
    }

//    /**
//    * Specify Validator class name
//    *
//    * @return mixed
//    */
//    public function validator()
//    {
//
//        return UserValidator::class;
//    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
