<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class OutletRepository extends Repository {

    public function model()
    {
        return 'App\Models\Outlet';
    }

}
