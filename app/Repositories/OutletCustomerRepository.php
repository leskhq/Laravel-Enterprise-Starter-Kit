<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class OutletCustomerRepository extends Repository {

    public function model()
    {
        return 'App\Models\OutletCustomer';
    }

}
