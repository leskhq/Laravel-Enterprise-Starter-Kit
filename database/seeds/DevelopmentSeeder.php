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

        // TODO: Remove this before release...
        // Look for and delete route named 'do-not-pre-load' if it exist.
        // That route is used to test a failure with the Authorization middleware and should not be loaded automatically.
        $routeToDelete = Route::where('name', 'test-acl.do-not-pre-load')->get()->first();
        if ($routeToDelete) Route::destroy($routeToDelete->id);


        $testUserOne = User::create([
            'username'              => 'user1',
            'first_name'            => 'User',
            'last_name'             => 'One',
            'email'                 => 'user1@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserTwo = User::create([
            'username'              => 'user2',
            'first_name'            => 'User',
            'last_name'             => 'Two',
            'email'                 => 'user2@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserThree = User::create([
            'username'              => 'user3',
            'first_name'            => 'User',
            'last_name'             => 'Three',
            'email'                 => 'user3@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserFour = User::create([
            'username'              => 'user4',
            'first_name'            => 'User',
            'last_name'             => 'Four',
            'email'                 => 'user4@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserFive = User::create([
            'username'              => 'user5',
            'first_name'            => 'User',
            'last_name'             => 'Five',
            'email'                 => 'user5@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserSix = User::create([
            'username'              => 'user6',
            'first_name'            => 'User',
            'last_name'             => 'Six',
            'email'                 => 'user6@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserSeven = User::create([
            'username'              => 'user7',
            'first_name'            => 'User',
            'last_name'             => 'Seven',
            'email'                 => 'user7@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserEight = User::create([
            'username'              => 'user8',
            'first_name'            => 'User',
            'last_name'             => 'Eight',
            'email'                 => 'user8@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserNine = User::create([
            'username'              => 'user9',
            'first_name'            => 'User',
            'last_name'             => 'Nine',
            'email'                 => 'user9@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserTen = User::create([
            'username'              => 'user10',
            'first_name'            => 'User',
            'last_name'             => 'Ten',
            'email'                 => 'user10@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserEleven = User::create([
            'username'              => 'user11',
            'first_name'            => 'User',
            'last_name'             => 'Eleven',
            'email'                 => 'user11@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserTwelve = User::create([
            'username'              => 'user12',
            'first_name'            => 'User',
            'last_name'             => 'Twelve',
            'email'                 => 'user12@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserThirteen = User::create([
            'username'              => 'user13',
            'first_name'            => 'User',
            'last_name'             => 'Thirteen',
            'email'                 => 'user13@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserFourteen = User::create([
            'username'              => 'user14',
            'first_name'            => 'User',
            'last_name'             => 'Fourteen',
            'email'                 => 'user14@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);
        $testUserFifteen = User::create([
            'username'              => 'user15',
            'first_name'            => 'User',
            'last_name'             => 'Fifteen',
            'email'                 => 'user15@email.com',
            "password"              => "Password1",
            "auth_type"             => "internal",
            "enabled"               => true
        ]);

        /////////
        // Create a few test permissions for the flash-test pages.
        $permTestLevelSuccess = Permission::create([
            'name'          => 'test-level-success',
            'display_name'  => 'Test level success',
            'description'   => 'Testing level success',
            'enabled'       => true,
        ]);
        $permTestLevelInfo = Permission::create([
            'name'          => 'test-level-info',
            'display_name'  => 'Test level info',
            'description'   => 'Testing level info',
            'enabled'       => true,
        ]);
        $permTestLevelWarning = Permission::create([
            'name'          => 'test-level-warning',
            'display_name'  => 'Test level warning',
            'description'   => 'Testing level warning',
            'enabled'       => true,
        ]);
        $permTestLevelError = Permission::create([
            'name'          => 'test-level-error',
            'display_name'  => 'Test level error',
            'description'   => 'Testing level error',
            'enabled'       => true,
        ]);


        ////////////////////////////////////
        // Create some roles for the flash test pages.
        ////////////////////////////////////
        // Success
        $roleFlashSuccessViewer = Role::create([
            "name"          => "flash-success-viewer",
            "display_name"  => "Flash success viewer",
            "description"   => "Can see the success flash test page.",
            "enabled"       => true
        ]);
        // Assign permission TestLevelSuccess
        $roleFlashSuccessViewer->perms()->attach($permTestLevelSuccess->id);
        // Assign user membership to role
        $roleFlashSuccessViewer->users()->attach($testUserTwo->id);

        // Info
        $roleFlashInfoViewer = Role::create([
            "name"          => "flash-info-viewer",
            "display_name"  => "Flash info viewer",
            "description"   => "Can see the info flash test page.",
            "enabled"       => true
        ]);
        // Assign permission Info and Success to the InfoViewer role.
        $roleFlashInfoViewer->perms()->attach($permTestLevelInfo->id);
        $roleFlashInfoViewer->perms()->attach($permTestLevelSuccess->id);
        // Assign user membership to role
        $roleFlashInfoViewer->users()->attach($testUserThree->id);

        // Warning
        $roleFlashWarningViewer = Role::create([
            "name"          => "flash-warning-viewer",
            "display_name"  => "Flash warning viewer",
            "description"   => "Can see the warning flash test page.",
            "enabled"       => true
        ]);
        // Assign permission Warning, Info and Success to the WarningViewer role.
        $roleFlashWarningViewer->perms()->attach($permTestLevelWarning->id);
        $roleFlashWarningViewer->perms()->attach($permTestLevelInfo->id);
        $roleFlashWarningViewer->perms()->attach($permTestLevelSuccess->id);
        // Assign user membership to role
        $roleFlashWarningViewer->users()->attach($testUserFour->id);

        // Error
        $roleFlashErrorViewer = Role::create([
            "name"          => "flash-error-viewer",
            "display_name"  => "Flash error viewer",
            "description"   => "Can see the error flash test page.",
            "enabled"       => true
        ]);
        // Assign permission Error, Warning, Info and Success to the ErrorViewer role.
        $roleFlashErrorViewer->perms()->attach($permTestLevelError->id);
        $roleFlashErrorViewer->perms()->attach($permTestLevelWarning->id);
        $roleFlashErrorViewer->perms()->attach($permTestLevelInfo->id);
        $roleFlashErrorViewer->perms()->attach($permTestLevelSuccess->id);
        // Assign user membership to role
        $roleFlashErrorViewer->users()->attach($testUserFive->id);



        /////////
        // Find basic-authenticated permission.
        $permBasicAuthenticated = Permission::where('name', 'basic-authenticated')->first();
        // Find guest-only permission.
        $permGuestOnly          = Permission::where('name', 'guest-only')->first();
        // Find open-to-all permission.
        $permOpenToAll          = Permission::where('name', 'open-to-all')->first();
        // Find admin-settings permission.
        $permAdminSettings          = Permission::where('name', 'admin-settings')->first();


        ////////////////////////////////////
        // Associate some permission to acl test routes
        $routeTestACLHome = Route::where('name', 'test-acl.home')->get()->first();
        $routeTestACLHome->permission()->associate($permOpenToAll);
        $routeTestACLHome->save();
        //
        $routeTestACLAdmins = Route::where('name', 'test-acl.admins')->get()->first();
        $routeTestACLAdmins->permission()->associate($permAdminSettings);
        $routeTestACLAdmins->save();
        //
        $routeTestACLBasicAuthenticated = Route::where('name', 'test-acl.basic-authenticated')->get()->first();
        $routeTestACLBasicAuthenticated->permission()->associate($permBasicAuthenticated);
        $routeTestACLBasicAuthenticated->save();
        //
        $routeTestACLGuestOnly = Route::where('name', 'test-acl.guest-only')->get()->first();
        $routeTestACLGuestOnly->permission()->associate($permGuestOnly);
        $routeTestACLGuestOnly->save();
        //
        $routeTestACLOpenToAll = Route::where('name', 'test-acl.open-to-all')->get()->first();
        $routeTestACLOpenToAll->permission()->associate($permOpenToAll);
        $routeTestACLOpenToAll->save();


        ////////////////////////////////////
        // Associate some permission to flash test routes
        $routeFlashHome = Route::where('name', 'test-flash.home')->get()->first();
        $routeFlashHome->permission()->associate($permOpenToAll);
        $routeFlashHome->save();
        //
        $routeFlashSuccess = Route::where('name', 'test-flash.success')->get()->first();
        $routeFlashSuccess->permission()->associate($permTestLevelSuccess);
        $routeFlashSuccess->save();
        //
        $routeFlashInfo = Route::where('name', 'test-flash.info')->get()->first();
        $routeFlashInfo->permission()->associate($permTestLevelInfo);
        $routeFlashInfo->save();
        //
        $routeFlashWarning = Route::where('name', 'test-flash.warning')->get()->first();
        $routeFlashWarning->permission()->associate($permTestLevelWarning);
        $routeFlashWarning->save();
        //
        $routeFlashError = Route::where('name', 'test-flash.error')->get()->first();
        $routeFlashError->permission()->associate($permTestLevelError);
        $routeFlashError->save();
        ////////////////////////////////////
        // Associate some permission to menu test routes
        $routeTestMenusHome = Route::where('name', 'test-menus.home')->get()->first();
        $routeTestMenusHome->permission()->associate($permOpenToAll);
        $routeTestMenusHome->save();
        //
        $routeTestMenusOne = Route::where('name', 'test-menus.one')->get()->first();
        $routeTestMenusOne->permission()->associate($permOpenToAll);
        $routeTestMenusOne->save();
        //
        $routeTestMenusTwo = Route::where('name', 'test-menus.two')->get()->first();
        $routeTestMenusTwo->permission()->associate($permBasicAuthenticated);
        $routeTestMenusTwo->save();
        //
        $routeTestMenusTwoA = Route::where('name', 'test-menus.two-a')->get()->first();
        $routeTestMenusTwoA->permission()->associate($permTestLevelSuccess);
        $routeTestMenusTwoA->save();
        //
        $routeTestMenusTwoB = Route::where('name', 'test-menus.two-b')->get()->first();
        $routeTestMenusTwoB->permission()->associate($permTestLevelInfo);
        $routeTestMenusTwoB->save();
        //
        $routeTestMenusThree = Route::where('name', 'test-menus.three')->get()->first();
        $routeTestMenusThree->permission()->associate($permTestLevelWarning);
        $routeTestMenusThree->save();


        /////////
        // Find home menu.
        $menuHome = Menu::where('name', 'home')->first();


        /////////
        // Create Test ACL menu folder
        $menuTestACL = Menu::create([
            'name'          => 'test-acl.home',
            'label'         => 'Test ACL',
            'position'      => 20,
            'icon'          => 'fa fa-bolt',
            'separator'     => false,
            'url'           => '/test-acl/home',
            'enabled'       => true,
            'parent_id'     => $menuHome->id,          // Parent is home.
            'route_id'      => null,
            'permission_id' => $permOpenToAll->id,
        ]);
        // Create DoNotPreLoad menu
        $menuDoNotPreLoad = Menu::create([
            'name'          => 'test-acl.do-not-pre-load',
            'label'         => 'Do not pre-load',
            'position'      => 0,
            'icon'          => 'fa fa-file',
            'separator'     => false,
            'url'           => '/test-acl/do-not-pre-load',
            'enabled'       => true,
            'parent_id'     => $menuTestACL->id,    // Parent is test-acl.home.
            'route_id'      => null,                // No route defined for this item
            'permission_id' => null,                // No permission specifically given.
        ]);
        // Create NoPerm menu
        $menuNoPerm = Menu::create([
            'name'          => 'test-acl.no-perm',
            'label'         => 'No perm',
            'position'      => 0,
            'icon'          => 'fa fa-file',
            'separator'     => false,
            'url'           => '/test-acl/no-perm',
            'enabled'       => true,
            'parent_id'     => $menuTestACL->id,    // Parent is test-acl.home.
            'route_id'      => null,                // No route defined for this item
            'permission_id' => null,                // No permission specifically given.
        ]);
        // Create GuestOnly menu
        $menuGuestOnly = Menu::create([
            'name'          => 'test-acl.guest-only',
            'label'         => 'Guest Only',
            'position'      => 0,
            'icon'          => 'fa fa-file',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestACL->id,    // Parent is test-acl.home.
            'route_id'      => $routeTestACLGuestOnly->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create OpenToAll menu
        $menuOpenToAll = Menu::create([
            'name'          => 'test-acl.open-to-all',
            'label'         => 'Open to all',
            'position'      => 0,
            'icon'          => 'fa fa-file',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestACL->id,    // Parent is test-acl.home.
            'route_id'      => $routeTestACLOpenToAll->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create BasicAuthenticated menu
        $menuBasicAuthenticated = Menu::create([
            'name'          => 'test-acl.basic-authenticated',
            'label'         => 'Basic authenticated',
            'position'      => 0,
            'icon'          => 'fa fa-file',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestACL->id,    // Parent is test-acl.home.
            'route_id'      => $routeTestACLBasicAuthenticated->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create Admins menu
        $menuAdmins = Menu::create([
            'name'          => 'test-acl.admins',
            'label'         => 'Admins',
            'position'      => 0,
            'icon'          => 'fa fa-file',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestACL->id,    // Parent is test-acl.home.
            'route_id'      => $routeTestACLAdmins->id,
            'permission_id' => null,                // Get permission from route.
        ]);
        // Create PowerUsers menu
        $menuPowerUsers = Menu::create([
            'name'          => 'test-acl.power-users',
            'label'         => 'Power users',
            'position'      => 0,
            'icon'          => 'fa fa-file',
            'separator'     => false,
            'url'           => '/test-acl/power-users',
            'enabled'       => true,
            'parent_id'     => $menuTestACL->id,    // Parent is test-acl.home.
            'route_id'      => null,
            'permission_id' => null,                // Get permission from route.
        ]);


        /////////
        // Create Test flash menu folder
        $menuTestFlashHome = Menu::create([
            'name'          => 'test-flash.home',
            'label'         => 'Test Flash',
            'position'      => 20,
            'icon'          => 'fa fa-bolt',
            'separator'     => false,
            'url'           => '/test-flash/home',
            'enabled'       => true,
            'parent_id'     => $menuHome->id,                // Parent is home.
            'route_id'      => null,
            'permission_id' => $permBasicAuthenticated->id,  // Specify basic-authenticated for url.
        ]);
        // Create Flash success menu
        $menuFlashSuccess = Menu::create([
            'name'          => 'test-flash.success',
            'label'         => 'Flash success',
            'position'      => 0,
            'icon'          => 'fa fa-check fa-colour-green',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestFlashHome->id,  // Parent is test-flash.home.
            'route_id'      => $routeFlashSuccess->id,
            'permission_id' => null,                    // Get permission from route.
        ]);
        // Create Flash info menu
        $menuFlashInfo = Menu::create([
            'name'          => 'test-flash.info',
            'label'         => 'Flash info',
            'position'      => 10,
            'icon'          => 'fa fa-info fa-colour-blue',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestFlashHome->id,  // Parent is test-flash.home.
            'route_id'      => $routeFlashInfo->id,
            'permission_id' => null,                    // Get permission from route.
        ]);
        // Create Flash warning menu
        $menuFlashWarning = Menu::create([
            'name'          => 'test-flash.warning',
            'label'         => 'Flash warning',
            'position'      => 20,
            'icon'          => 'fa fa-warning fa-colour-orange',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestFlashHome->id,  // Parent is test-flash.home.
            'route_id'      => $routeFlashWarning->id,
            'permission_id' => null,                    // Get permission from route.
        ]);
        // Create Flash error menu
        $menuFlashError = Menu::create([
            'name'          => 'test-flash.error',
            'label'         => 'Flash error',
            'position'      => 30,
            'icon'          => 'fa fa-ban fa-colour-red',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestFlashHome->id,  // Parent is test-flash.home.
            'route_id'      => $routeFlashError->id,
            'permission_id' => null,                    // Get permission from route.
        ]);


        /////////
        // Create Test menu folder
        $menuTestMenusHome = Menu::create([
            'name'          => 'test-menus.home',
            'label'         => 'Test Menus',
            'position'      => 30,
            'icon'          => 'fa fa-bolt',
            'separator'     => false,
            'url'           => '/test-menus/home',
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is home.
            'route_id'      => null,
            'permission_id' => $permOpenToAll->id,  // Specify open to all for url.
        ]);
        // Create Menu 1 menu
        $menuTestMenusOne = Menu::create([
            'name'          => 'test-menus.one',
            'label'         => 'Menu One',
            'position'      => 0,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestMenusHome->id,   // Parent is test-menus.home.
            'route_id'      => $routeTestMenusOne->id,
            'permission_id' => null,                     // Get permission from route.
        ]);
        // Create Menu 2 menu
        $menuTestMenusTwo = Menu::create([
            'name'          => 'test-menus.two',
            'label'         => 'Menu Two',
            'position'      => 10,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestMenusHome->id,   // Parent is test-menus.home.
            'route_id'      => $routeTestMenusTwo->id,
            'permission_id' => null,                     // Get permission from route.
        ]);
        // Create Menu 2a menu
        $menuTestMenusTwo2a = Menu::create([
            'name'          => 'test-menus.two-a',
            'label'         => 'Menu Two A',
            'position'      => 0,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestMenusTwo->id,   // Parent is test-menus.two.
            'route_id'      => $routeTestMenusTwoA->id,
            'permission_id' => null,                    // Get permission from route.
        ]);
        // Create Menu 2b menu
        $menuTestMenusTwo2b = Menu::create([
            'name'          => 'test-menus.two-b',
            'label'         => 'Menu Two B',
            'position'      => 10,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestMenusTwo->id,   // Parent is test-menus.two.
            'route_id'      => $routeTestMenusTwoB->id,
            'permission_id' => null,                    // Get permission from route.
        ]);
        // Create Menu 2a alias by URL
        $menuTestMenusTwo2a = Menu::create([
            'name'          => 'test-menus.two-a-alias-url',
            'label'         => 'Menu Two A alias by URL',
            'position'      => 0,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => '/test-menus/two-a',
            'enabled'       => true,
            'parent_id'     => $menuTestMenusTwo->id,       // Parent is test-menus.two.
            'route_id'      => null,
            'permission_id' => $permBasicAuthenticated->id, // Specify basic-authenticated.
        ]);
        // Create Menu 2a alias by ROUTE
        $menuTestMenusTwo2a = Menu::create([
            'name'          => 'test-menus.two-a-alias-route',
            'label'         => 'Menu Two A alias by route',
            'position'      => 0,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestMenusTwo->id,   // Parent is test-menus.two.
            'route_id'      => Route::where('name', 'like', "test-menus.two_a")->get()->first()->id,
            'permission_id' => null,                   // Get permission from route.
        ]);
        // Create Menu 3 menu
        $menuTestMenusTwo3 = Menu::create([
            'name'          => 'test-menus.three',
            'label'         => 'Menu Three',
            'position'      => 20,
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuTestMenusHome->id,   // Parent is test-menus.home.
            'route_id'      => $routeTestMenusThree->id,
            'permission_id' => null,                     // Get permission from route.
        ]);


    }
}
