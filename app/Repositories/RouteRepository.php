<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class RouteRepository extends Repository
{
    public function model()
    {
        return 'App\Models\Route';
    }

}
