<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class CustomerFollowupRepository extends Repository {

    public function model()
    {
        return 'App\Models\CustomerFollowup';
    }

}
