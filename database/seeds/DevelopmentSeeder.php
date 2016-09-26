<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Permission;
use App\Models\Menu;
use App\Models\Route;
use App\Models\Role;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /////////
        // Find basic-authenticated permission.
        $permBasicAuthenticated = Permission::where('name', 'basic-authenticated')->first();

        ////////////////////////////////////
        // Associate some permission to menu test reports
        $routeTestReportUsers = Route::where('name', 'test-reports.users')->get()->first();
        $routeTestReportUsers->permission()->associate($permBasicAuthenticated);
        $routeTestReportUsers->save();
        //
        $routeTestReportUsersData = Route::where('name', 'test-reports.users-data')->get()->first();
        $routeTestReportUsersData->permission()->associate($permBasicAuthenticated);
        $routeTestReportUsersData->save();
        //
        $routeTestReportRoutes = Route::where('name', 'test-reports.routes')->get()->first();
        $routeTestReportRoutes->permission()->associate($permBasicAuthenticated);
        $routeTestReportRoutes->save();
        //
        $routeTestReportRoutesData = Route::where('name', 'test-reports.routes-data')->get()->first();
        $routeTestReportRoutesData->permission()->associate($permBasicAuthenticated);
        $routeTestReportRoutesData->save();
        //
        $routeTestReportPerms = Route::where('name', 'test-reports.perms-and-roles-by-users')->get()->first();
        $routeTestReportPerms->permission()->associate($permBasicAuthenticated);
        $routeTestReportPerms->save();
        //
        $routeTestReportPermsData = Route::where('name', 'test-reports.perms-and-roles-by-users-data')->get()->first();
        $routeTestReportPermsData->permission()->associate($permBasicAuthenticated);
        $routeTestReportPermsData->save();

        /////////
        // Find home menu.
        $menuHome = Menu::where('name', 'home')->first();

        /////////
        // Create Test reports folder
        $menuTestReportsHome = Menu::create([
            'name'          => 'test-reports.home',
            'label'         => 'Test Reports',
            'position'      => 30,
            'icon'          => 'fa fa-print',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is home.
            'route_id'      => null,
            'permission_id' => $permBasicAuthenticated->id,  // Specify open to all for url.
        ]);
        // Create Menu users reports
        $menuTestReportsUsers = Menu::create([
            'name'          => 'test-reports.users',
            'label'         => 'Users',
            'position'      => 0,
            'icon'          => 'fa fa-user',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestReportsHome->id,   // Parent is test-menus.home.
            'route_id'      => $routeTestReportUsers->id,
            'permission_id' => null,                     // Get permission from route.
        ]);
        // Create Menu routes reports
        $menuTestReportsUsers = Menu::create([
            'name'          => 'test-reports.routes',
            'label'         => 'Routes',
            'position'      => 0,
            'icon'          => 'fa fa-road',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestReportsHome->id,   // Parent is test-menus.home.
            'route_id'      => $routeTestReportRoutes->id,
            'permission_id' => null,                     // Get permission from route.
        ]);
        // Create Menu routes reports
        $menuTestReportsUsers = Menu::create([
            'name'          => 'test-reports.perms-and-roles-by-users',
            'label'         => 'Permisssions',
            'position'      => 0,
            'icon'          => 'fa fa-bolt',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestReportsHome->id,   // Parent is test-menus.home.
            'route_id'      => $routeTestReportPerms->id,
            'permission_id' => null,                     // Get permission from route.
        ]);

    }
}
