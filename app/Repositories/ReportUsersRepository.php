<?php namespace App\Repositories;

use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReportUsersRepository
 *
 * Showing how to build a report repository using the Eloquent ORM method.
 *
 *
 * @package App\Repositories
 */
class ReportUsersRepository extends EloquentRepositoryAbstract {

    public function __construct(Model $Model)
    {
        $this->Database = $Model;

        $this->visibleColumns = array('id', 'first_name', 'last_name', 'username', 'email', 'created_at', 'updated_at', 'enabled');

        $this->orderBy = array(array('users.last_name', 'asc'), array('users.first_name', 'asc'));
    }
}
