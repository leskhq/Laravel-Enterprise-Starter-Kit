<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class ProductRepository extends Repository {

    public function model()
    {
        return 'App\Models\Product';
    }

}
