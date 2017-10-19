<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


///////
// Canned auth routes.
Auth::routes();

///////
// Registration terms
Route::get( 'faust',                    ['as' => 'faust',                   'uses' => 'FaustController@index']);

///////
// Home
Route::get('/', 		['as' => 'backslash', 'uses' => 'HomeController@index']);
Route::get('index',     ['as' => 'index',     'uses' => 'HomeController@index']);
Route::get('home',      ['as' => 'home',      'uses' => 'HomeController@index']);
Route::get('welcome',   ['as' => 'welcome',   'uses' => 'HomeController@welcome']);
Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

///////
// Admin
Route::prefix('admin')->group(function () {
    // Permissions
    Route::post  ('permissions/enableSelected',                ['as' => 'admin.permissions.enable-selected',  'uses' => 'PermissionsController@enableSelected']);
    Route::post  ('permissions/disableSelected',               ['as' => 'admin.permissions.disable-selected', 'uses' => 'PermissionsController@disableSelected']);
    Route::get   ('permissions/create',                        ['as' => 'admin.permissions.create',           'uses' => 'PermissionsController@create' ]);
    Route::patch ('permissions/{permissionId}',                ['as' => 'admin.permissions.update',           'uses' => 'PermissionsController@update' ]);
    Route::get   ('permissions/{permissionId}',                ['as' => 'admin.permissions.show',             'uses' => 'PermissionsController@show'   ]);
    Route::delete('permissions/{permissionId}',                ['as' => 'admin.permissions.destroy',          'uses' => 'PermissionsController@destroy']);
    Route::get   ('permissions/{permissionId}/edit',           ['as' => 'admin.permissions.edit',             'uses' => 'PermissionsController@edit'   ]);
    Route::post  ('permissions/{permissionId}/edit',           ['as' => 'admin.permissions.editPost',         'uses' => 'PermissionsController@edit'   ]);
    Route::get   ('permissions/{permissionId}/confirm-delete', ['as' => 'admin.permissions.confirm-delete',   'uses' => 'PermissionsController@getModalDelete']);
    Route::get   ('permissions/{permissionId}/delete',         ['as' => 'admin.permissions.delete',           'uses' => 'PermissionsController@destroy']);
    Route::get   ('permissions/{permissionId}/enable',         ['as' => 'admin.permissions.enable',           'uses' => 'PermissionsController@enable']);
    Route::get   ('permissions/{permissionId}/disable',        ['as' => 'admin.permissions.disable',          'uses' => 'PermissionsController@disable']);
    Route::post  ('permissions/store',                         ['as' => 'admin.permissions.store',            'uses' => 'PermissionsController@store'  ]);
    Route::get   ('permissions',                               ['as' => 'admin.permissions.index',            'uses' => 'PermissionsController@index'  ]);
    Route::post  ('permissions',                               ['as' => 'admin.permissions.indexPost',        'uses' => 'PermissionsController@index'  ]);
    // Roles
//    Route::get(   'roles/search',      ['as' => 'admin.roles.search',   'uses' => 'RolesController@searchByName']);
//    Route::post(  'roles/getInfo',     ['as' => 'admin.roles.get-info', 'uses' => 'RolesController@getInfo']);

    Route::post  ('roles/enableSelected',          ['as' => 'admin.roles.enable-selected',  'uses' => 'RolesController@enableSelected']);
    Route::post  ('roles/disableSelected',         ['as' => 'admin.roles.disable-selected', 'uses' => 'RolesController@disableSelected']);
    Route::get   ('roles/create',                  ['as' => 'admin.roles.create',           'uses' => 'RolesController@create' ]);
    Route::patch ('roles/{roleId}',                ['as' => 'admin.roles.update',           'uses' => 'RolesController@update' ]);
    Route::get   ('roles/{roleId}',                ['as' => 'admin.roles.show',             'uses' => 'RolesController@show'   ]);
    Route::delete('roles/{roleId}',                ['as' => 'admin.roles.destroy',          'uses' => 'RolesController@destroy']);
    Route::get   ('roles/{roleId}/edit',           ['as' => 'admin.roles.edit',             'uses' => 'RolesController@edit'   ]);
    Route::post  ('roles/{roleId}/edit',           ['as' => 'admin.roles.editPost',         'uses' => 'RolesController@edit'   ]);
    Route::get   ('roles/{roleId}/confirm-delete', ['as' => 'admin.roles.confirm-delete',   'uses' => 'RolesController@getModalDelete']);
    Route::get   ('roles/{roleId}/delete',         ['as' => 'admin.roles.delete',           'uses' => 'RolesController@destroy']);
    Route::get   ('roles/{roleId}/enable',         ['as' => 'admin.roles.enable',           'uses' => 'RolesController@enable']);
    Route::get   ('roles/{roleId}/disable',        ['as' => 'admin.roles.disable',          'uses' => 'RolesController@disable']);
    Route::post  ('roles/store',                   ['as' => 'admin.roles.store',            'uses' => 'RolesController@store'  ]);
    Route::get   ('roles',                         ['as' => 'admin.roles.index',            'uses' => 'RolesController@index'  ]);
    Route::post  ('roles',                         ['as' => 'admin.roles.indexPost',        'uses' => 'RolesController@index'  ]);
    // Routes
    Route::get   ('routes/load',                     ['as' => 'admin.routes.load',             'uses' => 'RoutesController@load']);
    Route::post  ('routes/enableSelected',           ['as' => 'admin.routes.enable-selected',  'uses' => 'RoutesController@enableSelected']);
    Route::post  ('routes/disableSelected',          ['as' => 'admin.routes.disable-selected', 'uses' => 'RoutesController@disableSelected']);
    Route::post  ('routes/savePerms',                ['as' => 'admin.routes.save-perms',       'uses' => 'RoutesController@savePerms']);
    Route::get   ('routes/create',                   ['as' => 'admin.routes.create',           'uses' => 'RoutesController@create' ]);
    Route::patch ('routes/{routeId}',                ['as' => 'admin.routes.update',           'uses' => 'RoutesController@update' ]);
    Route::get   ('routes/{routeId}',                ['as' => 'admin.routes.show',             'uses' => 'RoutesController@show'   ]);
    Route::delete('routes/{routeId}',                ['as' => 'admin.routes.destroy',          'uses' => 'RoutesController@destroy']);
    Route::get   ('routes/{routeId}/edit',           ['as' => 'admin.routes.edit',             'uses' => 'RoutesController@edit'   ]);
    Route::post  ('routes/{routeId}/edit',           ['as' => 'admin.routes.editPost',         'uses' => 'RoutesController@edit'   ]);
    Route::get   ('routes/{routeId}/confirm-delete', ['as' => 'admin.routes.confirm-delete',   'uses' => 'RoutesController@getModalDelete']);
    Route::get   ('routes/{routeId}/delete',         ['as' => 'admin.routes.delete',           'uses' => 'RoutesController@destroy']);
    Route::get   ('routes/{routeId}/enable',         ['as' => 'admin.routes.enable',           'uses' => 'RoutesController@enable']);
    Route::get   ('routes/{routeId}/disable',        ['as' => 'admin.routes.disable',          'uses' => 'RoutesController@disable']);
    Route::post  ('routes/store',                    ['as' => 'admin.routes.store',            'uses' => 'RoutesController@store'  ]);
    Route::get   ('routes',                          ['as' => 'admin.routes.index',            'uses' => 'RoutesController@index'  ]);
    Route::post  ('routes',                          ['as' => 'admin.routes.indexPost',        'uses' => 'RoutesController@index'  ]);
    // Users
    Route::post  ('users/enableSelected',          ['as' => 'admin.users.enable-selected',  'uses' => 'UsersController@enableSelected']);
    Route::post  ('users/disableSelected',         ['as' => 'admin.users.disable-selected', 'uses' => 'UsersController@disableSelected']);
    Route::get   ('users/create',                  ['as' => 'admin.users.create',           'uses' => 'UsersController@create' ]);
    Route::patch ('users/{userId}',                ['as' => 'admin.users.update',           'uses' => 'UsersController@update' ]);
    Route::get   ('users/{userId}',                ['as' => 'admin.users.show',             'uses' => 'UsersController@show'   ]);
    Route::delete('users/{userId}',                ['as' => 'admin.users.destroy',          'uses' => 'UsersController@destroy']);
    Route::get   ('users/{userId}/edit',           ['as' => 'admin.users.edit',             'uses' => 'UsersController@edit'   ]);
    Route::post  ('users/{userId}/edit',           ['as' => 'admin.users.editPost',         'uses' => 'UsersController@edit'   ]);
    Route::get   ('users/{userId}/confirm-delete', ['as' => 'admin.users.confirm-delete',   'uses' => 'UsersController@getModalDelete']);
    Route::get   ('users/{userId}/delete',         ['as' => 'admin.users.delete',           'uses' => 'UsersController@destroy']);
    Route::get   ('users/{userId}/enable',         ['as' => 'admin.users.enable',           'uses' => 'UsersController@enable']);
    Route::get   ('users/{userId}/disable',        ['as' => 'admin.users.disable',          'uses' => 'UsersController@disable']);
    Route::post  ('users/store',                   ['as' => 'admin.users.store',            'uses' => 'UsersController@store'  ]);
    Route::get   ('users',                         ['as' => 'admin.users.index',            'uses' => 'UsersController@index'  ]);
    Route::post  ('users',                         ['as' => 'admin.users.indexPost',        'uses' => 'UsersController@index'  ]);

    // Settings routes
    Route::post  ('settings',                             ['as' => 'admin.settings.store',                   'uses' => 'SettingsController@store']);
    Route::get   ('settings',                             ['as' => 'admin.settings.index',                   'uses' => 'SettingsController@index']);
    Route::get   ('settings/load',                        ['as' => 'admin.settings.load',                    'uses' => 'SettingsController@load']);
    Route::get   ('settings/create',                      ['as' => 'admin.settings.create',                  'uses' => 'SettingsController@create']);
    Route::get   ('settings/confirm-delete-selected',     ['as' => 'admin.settings.confirm-delete-selected', 'uses' => 'SettingsController@getModalDeleteSelected']);
    Route::post  ('settings/destroy-selected',            ['as' => 'admin.settings.destroy-selected',        'uses' => 'SettingsController@destroySelected']);
    Route::get   ('settings/{settingKey}',                ['as' => 'admin.settings.show',                    'uses' => 'SettingsController@show']);
    Route::patch ('settings/{settingKey}',                ['as' => 'admin.settings.patch',                   'uses' => 'SettingsController@update']);
    Route::put   ('settings/{settingKey}',                ['as' => 'admin.settings.update',                  'uses' => 'SettingsController@update']);
    Route::delete('settings/{settingKey}',                ['as' => 'admin.settings.destroy',                 'uses' => 'SettingsController@destroy']);
    Route::get   ('settings/{settingKey}/edit',           ['as' => 'admin.settings.edit',                    'uses' => 'SettingsController@edit']);
    Route::get   ('settings/{settingKey}/confirm-delete', ['as' => 'admin.settings.confirm-delete',          'uses' => 'SettingsController@getModalDelete']);
    Route::get   ('settings/{settingKey}/delete',         ['as' => 'admin.settings.delete',                  'uses' => 'SettingsController@destroy']);

});
