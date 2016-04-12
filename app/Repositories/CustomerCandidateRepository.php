<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class CustomerCandidateRepository extends Repository {

    public function model()
    {
        return 'App\Models\CustomerCandidate';
    }

}
