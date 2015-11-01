<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Route;

class ProductionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(/* User $user, Role $role */)
    {
        ////////////////////////////////////
        // Load the routes
        Route::loadLaravelRoutes();
        // Look for and delete route named 'do-not-load' if it exist.
        // That route is used to test the Authorization middleware and should not be loaded automatically.
        $routeToDelete = Route::where('name', 'do-not-load')->get()->first();
        if ($routeToDelete) Route::destroy($routeToDelete->id);


        ////////////////////////////////////
        // Create basic set of permissions
        $permGuestOnly = Permission::create([
            'name'          => 'guest-only',
            'display_name'  => 'Guest only access',
            'description'   => 'Only guest users can access these.',
            'enabled'       => true,
        ]);
        $permOpenToAll = Permission::create([
            'name'          => 'open-to-all',
            'display_name'  => 'Open to all',
            'description'   => 'Everyone can access these, even unauthenticated (guest) users.',
            'enabled'       => true,
        ]);
        $permBasicAuthenticated = Permission::create([
            'name'          => 'basic-authenticated',
            'display_name'  => 'Basic authenticated',
            'description'   => 'Basic permission after being authenticated.',
            'enabled'       => true,
        ]);
        // Create a few permissions for the admin|security section
        $permManageUsers = Permission::create([
            'name'          => 'manage-users',
            'display_name'  => 'Manage users',
            'description'   => 'Allows a user to manage the site users.',
            'enabled'       => true,
        ]);
        $permManageRoles = Permission::create([
            'name'          => 'manage-roles',
            'display_name'  => 'Manage roles',
            'description'   => 'Allows a user to manage the site roles.',
            'enabled'       => true,
        ]);
        $permManagePermissions = Permission::create([
            'name'          => 'manage-permissions',
            'display_name'  => 'Manage permissions',
            'description'   => 'Allows a user to manage the site permissions.',
            'enabled'       => true,
        ]);
        $permManageRoutes = Permission::create([
            'name'          => 'manage-routes',
            'display_name'  => 'Manage routes',
            'description'   => 'Allows a user to Manage the site routes.',
            'enabled'       => true,
        ]);
        // Create a few permissions for the admin|audit section
        $permAuditLogView = Permission::create([
            'name'          => 'audit-log-view',
            'display_name'  => 'View audit log',
            'description'   => 'Allows a user to view the audit log.',
            'enabled'       => true,
        ]);
        $permAuditReplay = Permission::create([
            'name'          => 'audit-log-replay',
            'display_name'  => 'Replay audit log item',
            'description'   => 'Allows a user to replay items from the audit log.',
            'enabled'       => true,
        ]);
        $permAuditPurge = Permission::create([
            'name'          => 'audit-log-purge',
            'display_name'  => 'Purge audit log',
            'description'   => 'Allows a user to purge old items from the audit log.',
            'enabled'       => true,
        ]);


        ////////////////////////////////////
        // Associate open-to-all permission to some routes
        $routeBackslash = Route::where('name', 'backslash')->get()->first();
        $routeBackslash->permission()->associate($permOpenToAll);
        $routeBackslash->save();
        $routeHome = Route::where('name', 'home')->get()->first();
        $routeHome->permission()->associate($permOpenToAll);
        $routeHome->save();
        $routeFaust = Route::where('name', 'faust')->get()->first();
        $routeFaust->permission()->associate($permOpenToAll);
        $routeFaust->save();
        // Associate basic-authenticated permission to the dashboard route
        $routeDashboard = Route::where('name', 'dashboard')->get()->first();
        $routeDashboard->permission()->associate($permBasicAuthenticated);
        $routeDashboard->save();
        // Associate the audit-log permissions
        $routeAuditView = Route::where('name', 'admin.audit.index')->get()->first();
        $routeAuditView->permission()->associate($permAuditLogView);
        $routeAuditView->save();
        $routeAuditPurge = Route::where('name', 'admin.audit.purge')->get()->first();
        $routeAuditPurge->permission()->associate($permAuditPurge);
        $routeAuditPurge->save();
        $routeAuditReplay = Route::where('name', 'admin.audit.replay')->get()->first();
        $routeAuditReplay->permission()->associate($permAuditReplay);
        $routeAuditReplay->save();
        // Associate manage-permission permissions to routes starting with 'admin.permissions.'
        $managePermRoutes = Route::where('name', 'like', "admin.permissions.%")->get()->all();
        foreach ($managePermRoutes as $route)
        {
            $route->permission()->associate($permManagePermissions);
            $route->save();
        }
        // Associate manage-roles permissions to routes starting with 'admin.roles.'
        $manageRoleRoutes = Route::where('name', 'like', "admin.roles.%")->get()->all();
        foreach ($manageRoleRoutes as $route)
        {
            $route->permission()->associate($permManageRoles);
            $route->save();
        }
        // Associate manage-routes permissions to routes starting with 'admin.routes.'
        $manageRouteRoutes = Route::where('name', 'like', "admin.routes.%")->get()->all();
        foreach ($manageRouteRoutes as $route)
        {
            $route->permission()->associate($permManageRoutes);
            $route->save();
        }
        // Associate manage-users permissions to routes starting with 'admin.users.'
        $manageUserRoutes = Route::where('name', 'like', "admin.users.%")->get()->all();
        foreach ($manageUserRoutes as $route)
        {
            $route->permission()->associate($permManageUsers);
            $route->save();
        }


        ////////////////////////////////////
        // Create role: admins
        $roleAdmins = Role::create([
            "name"          => "admins",
            "display_name"  => "Administrators",
            "description"   => "Administrators have no restrictions",
            "enabled"       => true
            ]);
        // Create role: users
        // Assign permission basic-authenticated
        $roleUsers = Role::create([
            "name"          => "users",
            "display_name"  => "Users",
            "description"   => "All authenticated users",
            "enabled"       => true
            ]);
        $roleUsers->perms()->attach($permBasicAuthenticated->id);
        // Create role: user-manager
        // Assign permission manage-users
        $roleUserManagers = Role::create([
            "name"          => "user-managers",
            "display_name"  => "User managers",
            "description"   => "User managers are granted all permissions to the Admin|Users section.",
            "enabled"       => true
        ]);
        $roleUserManagers->perms()->attach($permManageUsers->id);
        // Create role: role-manager
        // Assign permission: manage-roles
        $roleRoleManagers = Role::create([
            "name"          => "role-managers",
            "display_name"  => "Role managers",
            "description"   => "Role managers are granted all permissions to the Admin|Roles section.",
            "enabled"       => true
        ]);
        $roleRoleManagers->perms()->attach($permManageRoles->id);
        // Create role: audit-viewers
        // Assign permission: audit-log-view
        $roleAuditViewers = Role::create([
            "name"          => "audit-viewers",
            "display_name"  => "Audit viewers",
            "description"   => "Users allowed to view the audit log.",
            "enabled"       => true
        ]);
        $roleAuditViewers->perms()->attach($permAuditLogView->id);
        // Create role: audit-replayers
        // Assign permission: audit-log-replay
        $roleAuditReplayers = Role::create([
            "name"          => "audit-replayers",
            "display_name"  => "Audit replayers",
            "description"   => "Users allowed to replay items from the audit log.",
            "enabled"       => true
        ]);
        $roleAuditReplayers->perms()->attach($permAuditReplay->id);
        // Create role: audit-purgers
        // Assign permission: audit-log-purge
        $roleAuditPurgers = Role::create([
            "name"          => "audit-purgers",
            "display_name"  => "Audit purgers",
            "description"   => "Users allowed to purge old items from the audit log.",
            "enabled"       => true
        ]);
        $roleAuditPurgers->perms()->attach($permAuditPurge->id);


        ////////////////////////////////////
        // Create user: root
        // Assign membership to role admins, membership to role users is
        // automatic.
        $userRoot = User::create([
            "first_name"    => "Root",
            "last_name"     => "SuperUser",
            "username"      => "root",
            "email"         => "root@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userRoot->roles()->attach($roleAdmins->id);



    }
}
