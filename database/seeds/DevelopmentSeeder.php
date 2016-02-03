<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Permission;
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


    }
}
