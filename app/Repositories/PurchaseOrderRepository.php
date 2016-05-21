<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class PurchaseOrderRepository extends Repository {

    public function model()
    {
        return 'App\Models\PurchaseOrder';
    }

}
