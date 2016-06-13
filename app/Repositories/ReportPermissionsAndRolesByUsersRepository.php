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
class ReportPermissionsAndRolesByUsersRepository extends EloquentRepositoryAbstract {

    public function __construct()
    {

        $this->Database = DB::table('v_permissions_and_roles_by_users');

        $this->visibleColumns = array('user_id', 'username', 'user_permission', 'role', 'role_permission');

        $this->orderBy = array(array('username', 'asc'));
    }
}

