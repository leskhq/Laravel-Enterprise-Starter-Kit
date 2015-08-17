<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
// Registration routes...
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', 'Auth\AuthController@postRegister');
// Password reset link request routes...
Route::get('password/email', ['as' => 'recover_password', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
// Registration terms
Route::get('faust', ['as' => 'faust', 'uses' => function(){
    return view('faust');
}]);

// Application routes...
Route::get('/', 'HomeController@index');
Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

// Routes in this group must be authorized.
Route::group(['middleware' => 'authorize'], function () {
    // Application routes...
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    // Site administration section
    Route::group(['prefix' => 'admin'], function () {
        // TODO: manually specify all needed routes instead of using Route::resource(...)

        Route::post('users/enableSelected',         ['as' => 'admin.users.enable-selected',  'uses' => 'UsersController@enableSelected']);
        Route::post('users/disableSelected',        ['as' => 'admin.users.disable-selected', 'uses' => 'UsersController@disableSelected']);
        Route::get( 'users/search',                 ['as' => 'admin.users.search',           'uses' => 'UsersController@searchByName']);
        Route::get( 'users/list',                   ['as' => 'admin.users.search',           'uses' => 'UsersController@listByPage']);
        Route::resource('users', 'UsersController');
        Route::get('users/{userId}/confirm-delete', ['as' => 'admin.users.confirm-delete', 'uses' => 'UsersController@getModalDelete']);
        Route::get('users/{userId}/delete',         ['as' => 'admin.users.delete',         'uses' => 'UsersController@destroy']);
        Route::get( 'users/{userId}/enable',        ['as' => 'admin.users.enable',         'uses' => 'UsersController@enable']);
        Route::get( 'users/{userId}/disable',       ['as' => 'admin.users.disable',        'uses' => 'UsersController@disable']);

        Route::post('roles/enableSelected',         ['as' => 'admin.roles.enable-selected',  'uses' => 'RolesController@enableSelected']);
        Route::post('roles/disableSelected',        ['as' => 'admin.roles.disable-selected', 'uses' => 'RolesController@disableSelected']);
        Route::get( 'roles/search',                 ['as' => 'admin.roles.search',           'uses' => 'RolesController@searchByName']);
        Route::resource('roles', 'RolesController');
        Route::get('roles/{roleId}/confirm-delete', ['as' => 'admin.roles.confirm-delete',   'uses' => 'RolesController@getModalDelete']);
        Route::get('roles/{roleId}/delete',         ['as' => 'admin.roles.delete',           'uses' => 'RolesController@destroy']);
        Route::get( 'roles/{roleId}/enable',        ['as' => 'admin.roles.enable',           'uses' => 'RolesController@enable']);
        Route::get( 'roles/{roleId}/disable',       ['as' => 'admin.roles.disable',          'uses' => 'RolesController@disable']);

        Route::get('permissions/generate',                      ['as' => 'admin.permissions.generate',         'uses' => 'PermissionsController@generate']);
        Route::post('permissions/enableSelected',               ['as' => 'admin.permissions.enable-selected',  'uses' => 'PermissionsController@enableSelected']);
        Route::post('permissions/disableSelected',              ['as' => 'admin.permissions.disable-selected', 'uses' => 'PermissionsController@disableSelected']);
        Route::resource('permissions', 'PermissionsController');
        Route::get('permissions/{permissionId}/confirm-delete', ['as' => 'admin.permissions.confirm-delete',   'uses' => 'PermissionsController@getModalDelete']);
        Route::get('permissions/{permissionId}/delete',         ['as' => 'admin.permissions.delete',           'uses' => 'PermissionsController@destroy']);
        Route::get( 'permissions/{permissionId}/enable',        ['as' => 'admin.permissions.enable',           'uses' => 'PermissionsController@enable']);
        Route::get( 'permissions/{permissionId}/disable',       ['as' => 'admin.permissions.disable',          'uses' => 'PermissionsController@disable']);

        Route::get( 'routes/load',                     ['as' => 'admin.routes.load',             'uses' => 'RoutesController@load']);
        Route::post('routes/enableSelected',           ['as' => 'admin.routes.enable-selected',  'uses' => 'RoutesController@enableSelected']);
        Route::post('routes/disableSelected',          ['as' => 'admin.routes.disable-selected', 'uses' => 'RoutesController@disableSelected']);
        Route::post('routes/savePerms',                ['as' => 'admin.routes.save-perms',       'uses' => 'RoutesController@savePerms']);
        Route::resource('routes', 'RoutesController');
        Route::get( 'routes/{routeId}/confirm-delete', ['as' => 'admin.routes.confirm-delete',   'uses' => 'RoutesController@getModalDelete']);
        Route::get( 'routes/{routeId}/delete',         ['as' => 'admin.routes.delete',           'uses' => 'RoutesController@destroy']);
        Route::get( 'routes/{routeId}/enable',         ['as' => 'admin.routes.enable',           'uses' => 'RoutesController@enable']);
        Route::get( 'routes/{routeId}/disable',        ['as' => 'admin.routes.disable',          'uses' => 'RoutesController@disable']);

    });

    // Template tests and demo routes
    Route::get('flashsuccess',  ['as' => 'flash_test_success',  'uses' => 'TestController@flash_success']);
    Route::get('flashinfo',     ['as' => 'flash_test_info',     'uses' => 'TestController@flash_info']);
    Route::get('flashwarning',  ['as' => 'flash_test_warning',  'uses' => 'TestController@flash_warning']);
    Route::get('flasherror',    ['as' => 'flash_test_error',    'uses' => 'TestController@flash_error']);

    // Authorization tests
    Route::group(['prefix' => 'acl-test'], function () {
        Route::get('do-not-load',           ['as' => 'do-not-load',         'uses' => 'TestController@acl_test_do_not_load']);
        Route::get('no-perm',               ['as' => 'no-perm',             'uses' => 'TestController@acl_test_no_perm']);
        Route::get('basic-authenticated',   ['as' => 'basic-authenticated', 'uses' => 'TestController@acl_test_basic_authenticated']);
        Route::get('guest-only',            ['as' => 'guest-only',          'uses' => 'TestController@acl_test_guest_only']);
        Route::get('open-to-all',           ['as' => 'open-to-all',         'uses' => 'TestController@acl_test_open_to_all']);
        Route::get('admins',                ['as' => 'admins',              'uses' => 'TestController@acl_test_admins']);
        Route::get('power-users',           ['as' => 'power-users',         'uses' => 'TestController@acl_test_power_users']);
    });
});
