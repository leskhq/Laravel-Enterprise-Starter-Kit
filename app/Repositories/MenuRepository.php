<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class MenuRepository extends Repository
{
    public function model()
    {
        return 'App\Models\Menu';
    }

}
