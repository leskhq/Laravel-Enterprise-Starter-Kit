<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class SupplierRepository extends Repository {

    public function model()
    {
        return 'App\Models\Supplier';
    }

}
