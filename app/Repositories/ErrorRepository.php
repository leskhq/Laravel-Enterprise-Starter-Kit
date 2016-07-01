<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class ErrorRepository extends Repository {

    public function model()
    {
        return 'App\Models\Error';
    }

}
