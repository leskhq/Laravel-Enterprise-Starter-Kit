<?php namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class CandidateFollowupByCandidateType extends Criteria {

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
        $model = $model->where('customerCandidate.type', $this->int);
        return $model;
    }

}
