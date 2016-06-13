<?php namespace App\Repositories;

use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class ReportRoutesRepository
 *
 *
 *
 * @package App\Repositories
 */
class ReportRoutesRepository extends EloquentRepositoryAbstract {

    public function __construct()
    {
        $this->Database = DB::table('routes')
            ->join('permissions', 'routes.permission_id', '=', 'permissions.id');

        $this->visibleColumns = array('routes.id', 'routes.name', 'routes.permission_id', 'permissions.name as perm_name', 'routes.created_at', 'routes.updated_at', 'routes.enabled');

        $this->orderBy = array(array('routes.name', 'asc'), array('permissions.name', 'asc'));
    }
}
