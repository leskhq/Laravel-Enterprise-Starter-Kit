<?php namespace App\Repositories\Criteria\Audits;

use DateTime;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class AuditsCreatedBefore implements CriteriaInterface {

    protected $date;

    /**
     * AuditCreatedBefore constructor.
     * @param DateTime $date
     */
    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository )
    {
        $model = $model->where('created_at', '<', $this->date->format('Y-m-d'));
        return $model;
    }

}
