<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class UserRepository extends Repository
{
    public function model()
    {
        return 'App\User';
    }

}
