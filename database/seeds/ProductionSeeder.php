<?php

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Route;
use App\User;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ////////////////////////////////////
        // Load the routes
        Route::loadLaravelRoutes('/.*/');


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
        $permManageMenus = Permission::create([
            'name'          => 'manage-menus',
            'display_name'  => 'Manage menus',
            'description'   => 'Allows a user to manage the site menus.',
            'enabled'       => true,
        ]);
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
            'description'   => 'Allows a user to manage the site routes.',
            'enabled'       => true,
        ]);
        $permManageModules = Permission::create([
            'name'          => 'manage-modules',
            'display_name'  => 'Manage modules',
            'description'   => 'Allows a user to manage the site modules.',
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
        // Create permission to manage the site settings
        $permAdminSettings = Permission::create([
            'name'          => 'admin-settings',
            'display_name'  => 'Administer site settings',
            'description'   => 'Allows a user to change site settings.',
            'enabled'       => true,
        ]);
        // Create a few permissions for the admin|errors section
        $permErrorLogView = Permission::create([
            'name'          => 'error-log-view',
            'display_name'  => 'View error log',
            'description'   => 'Allows a user to view the error log.',
            'enabled'       => true,
        ]);
        $permErrorPurge = Permission::create([
            'name'          => 'error-log-purge',
            'display_name'  => 'Purge error log',
            'description'   => 'Allows a user to purge old items from the error log.',
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
        $routeWelcome = Route::where('name', 'welcome')->get()->first();
        $routeWelcome->permission()->associate($permOpenToAll);
        $routeWelcome->save();
        $routeFaust = Route::where('name', 'faust')->get()->first();
        $routeFaust->permission()->associate($permOpenToAll);
        $routeFaust->save();
        // Associate basic-authenticated permission to some routes
        $routeDashboard = Route::where('name', 'dashboard')->get()->first();
        $routeDashboard->permission()->associate($permBasicAuthenticated);
        $routeDashboard->save();
        $routeUserProfile = Route::where('name', 'user.profile')->get()->first();
        $routeUserProfile->permission()->associate($permBasicAuthenticated);
        $routeUserProfile->save();
        $routeUserProfilePatch = Route::where('name', 'user.profile.patch')->get()->first();
        $routeUserProfilePatch->permission()->associate($permBasicAuthenticated);
        $routeUserProfilePatch->save();
        // Associate the audit-log permissions
        $routeAuditView = Route::where('name', 'admin.audit.index')->get()->first();
        $routeAuditView->permission()->associate($permAuditLogView);
        $routeAuditView->save();
        $routeAuditShow = Route::where('name', 'admin.audit.show')->get()->first();
        $routeAuditShow->permission()->associate($permAuditLogView);
        $routeAuditShow->save();
        $routeAuditPurge = Route::where('name', 'admin.audit.purge')->get()->first();
        $routeAuditPurge->permission()->associate($permAuditPurge);
        $routeAuditPurge->save();
        $routeAuditReplay = Route::where('name', 'admin.audit.replay')->get()->first();
        $routeAuditReplay->permission()->associate($permAuditReplay);
        $routeAuditReplay->save();
        // Associate manage-menus permissions to routes starting with 'admin.menus.'
        $manageMenusRoutes = Route::where('name', 'like', "admin.menus.%")->get()->all();
        foreach ($manageMenusRoutes as $route)
        {
            $route->permission()->associate($permManageMenus);
            $route->save();
        }
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
        // Associate manage-modules permissions to routes starting with 'admin.modules.'
        $manageModulesRoutes = Route::where('name', 'like', "admin.modules.%")->get()->all();
        foreach ($manageModulesRoutes as $route)
        {
            $route->permission()->associate($permManageModules);
            $route->save();
        }
        // Associate manage-users permissions to routes starting with 'admin.users.'
        $manageUserRoutes = Route::where('name', 'like', "admin.users.%")->get()->all();
        foreach ($manageUserRoutes as $route)
        {
            $route->permission()->associate($permManageUsers);
            $route->save();
        }
        // Associate the admin-settings permissions
        $routeSettingsIndex = Route::where('name', 'admin.settings.index')->get()->first();
        $routeSettingsIndex->permission()->associate($permAdminSettings);
        $routeSettingsIndex->save();
        $routeSettingsStore = Route::where('name', 'admin.settings.store')->get()->first();
        $routeSettingsStore->permission()->associate($permAdminSettings);
        $routeSettingsStore->save();
        $routeSettingsDestroy = Route::where('name', 'admin.settings.destroy')->get()->first();
        $routeSettingsDestroy->permission()->associate($permAdminSettings);
        $routeSettingsDestroy->save();
        $routeSettingsShow = Route::where('name', 'admin.settings.show')->get()->first();
        $routeSettingsShow->permission()->associate($permAdminSettings);
        $routeSettingsShow->save();
        $routeSettingsPatch = Route::where('name', 'admin.settings.patch')->get()->first();
        $routeSettingsPatch->permission()->associate($permAdminSettings);
        $routeSettingsPatch->save();
        $routeSettingsUpdate = Route::where('name', 'admin.settings.update')->get()->first();
        $routeSettingsUpdate->permission()->associate($permAdminSettings);
        $routeSettingsUpdate->save();
        $routeSettingsConfirmDelete = Route::where('name', 'admin.settings.confirm-delete')->get()->first();
        $routeSettingsConfirmDelete->permission()->associate($permAdminSettings);
        $routeSettingsConfirmDelete->save();
        $routeSettingsDelete = Route::where('name', 'admin.settings.delete')->get()->first();
        $routeSettingsDelete->permission()->associate($permAdminSettings);
        $routeSettingsDelete->save();
        $routeSettingsEdit = Route::where('name', 'admin.settings.edit')->get()->first();
        $routeSettingsEdit->permission()->associate($permAdminSettings);
        $routeSettingsEdit->save();
        $routeSettingsCreate = Route::where('name', 'admin.settings.create')->get()->first();
        $routeSettingsCreate->permission()->associate($permAdminSettings);
        $routeSettingsCreate->save();
        $routeSettingsLoad = Route::where('name', 'admin.settings.load')->get()->first();
        $routeSettingsLoad->permission()->associate($permAdminSettings);
        $routeSettingsLoad->save();
        // Associate the error-log permissions
        $routeErrorView = Route::where('name', 'admin.errors.index')->get()->first();
        $routeErrorView->permission()->associate($permErrorLogView);
        $routeErrorView->save();
        $routeErrorShow = Route::where('name', 'admin.errors.show')->get()->first();
        $routeErrorShow->permission()->associate($permErrorLogView);
        $routeErrorShow->save();
        $routeErrorPurge = Route::where('name', 'admin.errors.purge')->get()->first();
        $routeErrorPurge->permission()->associate($permErrorPurge);
        $routeErrorPurge->save();


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
        // Create role: menu-manager
        // Assign permission manage-menus
        $roleMenuManagers = Role::create([
            "name"          => "menu-managers",
            "display_name"  => "Menu managers",
            "description"   => "Menu managers are granted all permissions to the Admin|Menus section.",
            "enabled"       => true
        ]);
        $roleMenuManagers->perms()->attach($permManageMenus->id);
        // Create role: user-manager
        // Assign permission manage-users
        $roleUserManagers = Role::create([
            "name"          => "user-managers",
            "display_name"  => "User managers",
            "description"   => "User managers are granted all permissions to the Admin|Users section.",
            "enabled"       => true
        ]);
        $roleUserManagers->perms()->attach($permManageUsers->id);
        // Create role: module-manager
        // Assign permission manage-modules
        $roleModuleManagers = Role::create([
            "name"          => "module-managers",
            "display_name"  => "Module managers",
            "description"   => "Module managers are granted all permissions to the Admin|Modules section.",
            "enabled"       => true
        ]);
        $roleModuleManagers->perms()->attach($permManageModules->id);
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
        // Create role: error-viewers
        // Assign permission: error-log-view
        $roleErrorViewers = Role::create([
            "name"          => "error-viewers",
            "display_name"  => "Error viewers",
            "description"   => "Users allowed to view the error log.",
            "enabled"       => true
        ]);
        $roleErrorViewers->perms()->attach($permErrorLogView->id);
        // Create role: error-purgers
        // Assign permission: error-log-purge
        $roleErrorPurgers = Role::create([
            "name"          => "error-purgers",
            "display_name"  => "Error purgers",
            "description"   => "Users allowed to purge old items from the error log.",
            "enabled"       => true
        ]);
        $roleErrorPurgers->perms()->attach($permErrorPurge->id);


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


        ////////////////////////////////////
        // Create menu: root
        $menuRoot = Menu::create([
//            'id'            => 0,                   // Hard-coded
            'name'          => 'root',
            'label'         => 'Root',
            'position'      => 0,
            'icon'          => 'fa fa-folder',      // No point setting this as root is not visible.
            'separator'     => false,
            'url'           => null,                // No URL, root is not rendered or visible.
            'enabled'       => true,                // Must be enabled or sub-menus will not be available.
//            'parent_id'     => 0,                   // Parent of itself.
            'route_id'      => null,                // No route, root cannot be reached.
            'permission_id' => $permOpenToAll->id,  // Must be visible to all, for all sub-menus to be visible.
        ]);
        // Force root parent to itself.
        $menuRoot->parent_id = $menuRoot->id;
        $menuRoot->save();
        // Create Home menu
        $menuHome = Menu::create([
            'name'          => 'home',
            'label'         => 'Home',
            'position'      => 0,
            'icon'          => 'fa fa-home fa-colour-green',
            'separator'     => false,
            'url'           => '/',
            'enabled'       => true,
            'parent_id'     => $menuRoot->id,       // Parent is root.
            'route_id'      => $routeHome->id,      // Route to home
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Dashboard menu
        $menuDashboard = Menu::create([
            'name'          => 'dashboard',
            'label'         => 'Dashboard',
            'position'      => 0,
            'icon'          => 'fa fa-dashboard',
            'separator'     => false,
            'url'           => '/dashboard',
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is root.
            'route_id'      => $routeDashboard->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Admin container.
        $menuAdmin = Menu::create([
            'name'          => 'admin',
            'label'         => 'Admin',
            'position'      => 999,                 // Artificially high number to ensure that it is rendered last.
            'icon'          => 'fa fa-cog',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuRoot->id,       // Parent is root.
            'route_id'      => null,                // No route
            'permission_id' => null,                // Get permission from sub-items. If the user has permission to see/use
                                                    // any sub-items, the admin menu will be rendered, otherwise it will
                                                    // not.
        ]);
        // Create Audit sub-menu
        $menuAudit = Menu::create([
            'name'          => 'audit',
            'label'         => 'Audit',
            'position'      => 0,
            'icon'          => 'fa fa-binoculars',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => $routeAuditView->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Error sub-menu
        $menuError = Menu::create([
            'name'          => 'error',
            'label'         => 'Error',
            'position'      => 1,
            'icon'          => 'fa fa-binoculars',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => $routeErrorView->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Modules sub-menu
        $menuModules = Menu::create([
            'name'          => 'modules',
            'label'         => 'Modules',
            'position'      => 2,
            'icon'          => 'fa fa-puzzle-piece',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => Route::where('name', 'like', "admin.modules.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Security container.
        $menuSecurity = Menu::create([
            'name'          => 'security',
            'label'         => 'Security',
            'position'      => 3,
            'icon'          => 'fa fa-user-secret fa-colour-red',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => null,                // No route
            'permission_id' => null,                // Get permission from sub-items.
        ]);
        // Create Menus sub-menu
        $menuMenus = Menu::create([
            'name'          => 'menus',
            'label'         => 'Menus',
            'position'      => 0,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.menus.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create separator
        $menuUsers = Menu::create([
            'name'          => 'menus-users-separator',
            'label'         => '-----',
            'position'      => 1,
            'icon'          => null,
            'separator'     => true,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => null,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Users sub-menu
        $menuUsers = Menu::create([
            'name'          => 'users',
            'label'         => 'Users',
            'position'      => 2,
            'icon'          => 'fa fa-user',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.users.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Roles sub-menu
        $menuRoles = Menu::create([
            'name'          => 'roles',
            'label'         => 'Roles',
            'position'      => 3,
            'icon'          => 'fa fa-users',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.roles.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Permissions sub-menu
        $menuPermissions = Menu::create([
            'name'          => 'permissions',
            'label'         => 'Permissions',
            'position'      => 4,
            'icon'          => 'fa fa-bolt',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.permissions.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Routes sub-menu
        $menuRoutes = Menu::create([
            'name'          => 'routes',
            'label'         => 'Routes',
            'position'      => 5,
            'icon'          => 'fa fa-road',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuSecurity->id,   // Parent is security.
            'route_id'      => Route::where('name', 'like', "admin.routes.index")->get()->first()->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Settings sub-menu
        $menuSettings = Menu::create([
            'name'          => 'setting',
            'label'         => 'Settings',
            'position'      => 4,
            'icon'          => 'fa fa-cogs',
            'separator'     => false,
            'url'           => null,                // Get URL from route.
            'enabled'       => true,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
            'route_id'      => $routeSettingsIndex->id,
            'permission_id' => null,                // Get permission from route.
        ]);

    }
}
