<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class PerfumeRepository extends Repository {

    public function model()
    {
        return 'App\Models\Perfume';
    }

}
