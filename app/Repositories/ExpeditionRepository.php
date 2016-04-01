<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class ExpeditionRepository extends Repository {

    public function model()
    {
        return 'App\Models\Expedition';
    }

}
