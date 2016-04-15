<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class SaleRepository extends Repository {

    public function model()
    {
        return 'App\Models\Sale';
    }

}
