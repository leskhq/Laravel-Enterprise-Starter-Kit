<?php

// Authentication routes...
Route::get( 'auth/login',             ['as' => 'login',                'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login',             ['as' => 'loginPost',            'uses' => 'Auth\AuthController@postLogin']);
Route::get( 'auth/logout',            ['as' => 'logout',               'uses' => 'Auth\AuthController@getLogout']);
// Registration routes...
Route::get( 'auth/register',          ['as' => 'register',             'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register',          ['as' => 'registerPost',         'uses' => 'Auth\AuthController@postRegister']);
// Password reset link request routes...
Route::get( 'password/email',         ['as' => 'recover_password',     'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email',         ['as' => 'recover_passwordPost', 'uses' => 'Auth\PasswordController@postEmail']);
// Password reset routes...
Route::get( 'password/reset/{token}', ['as' => 'reset_password',       'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset',         ['as' => 'reset_passwordPost',   'uses' => 'Auth\PasswordController@postReset']);
// Registration terms
Route::get( 'faust',                  ['as' => 'faust',                'uses' => 'FaustController@index']);

// Application routes...
Route::get( '/',       ['as' => 'backslash',   'uses' => 'HomeController@index']);
Route::get( 'home',    ['as' => 'home',        'uses' => 'HomeController@index']);

// Store
\App\Http\Controllers\StoreController::routes();
// Affiliate Controller
\App\Http\Controllers\AffController::routes();

// Routes in this group must be authorized.
Route::group(['middleware' => 'authorize'], function () {
    // Application routes...
    Route::get( 'dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::get( 'search',    ['as' => 'search',    'uses' => 'DashboardController@search']);

    // Member routes
    Route::get( 'checkout',        'StoreController@checkout')->name('store.member.checkout');

    // Site administration section
    Route::group(['prefix' => 'admin'], function () {
        // Affiliate
        \App\Http\Controllers\AffController::routes();
        // Store Orders 
        \App\Http\Controllers\StoreOrdersController::routes();
	    // partners
        \App\Http\Controllers\PartnersController::routes();
        // Expedition routes
        \App\Http\Controllers\ExpeditionsController::routes();
        // Product routes
        \App\Http\Controllers\ProductsController::routes();
        // Supplier routes
        \App\Http\Controllers\SuppliersController::routes();
        // Customer routes
        \App\Http\Controllers\CustomersController::routes();
        // Customer Candidate routes
        \App\Http\Controllers\CustomerCandidatesController::routes();
        // Customer Followup routes
        \App\Http\Controllers\CustomerFollowupsController::routes();
        // Customer Candidate Followup routes
        \App\Http\Controllers\CandidateFollowupsController::routes();
        // Sale routes
        \App\Http\Controllers\SalesController::routes();
        // Material routes
        \App\Http\Controllers\MaterialsController::routes();
        // Purchase Order routes
        \App\Http\Controllers\PurchaseOrdersController::routes();
        // Outlet routes
        \App\Http\Controllers\OutletsController::routes();
        // Formula routes
        \App\Http\Controllers\FormulasController::routes();
        // Formula Detail routes
        //======================================================================================================================/
        // User routes
        \App\Http\Controllers\UsersController::routes();
        // Role routes
        \App\Http\Controllers\RolesController::routes();
        // Menu routes
        \App\Http\Controllers\MenusController::routes();
        // Modules routes
        \App\Http\Controllers\ModulesController::routes();
        // Permission routes
        \App\Http\Controllers\PermissionsController::routes();
        // Route routes
        \App\Http\Controllers\RoutesController::routes();
        // Audit routes
        \App\Http\Controllers\AuditsController::routes();
        // Settings routes
        // TODO: Implements settings
        Route::get('settings', ['as' => 'admin.settings.index', 'uses' => 'TestController@test_flash_warning']);
    }); // End of ADMIN group

    // Outlet Owner section
    Route::group(['prefix' => 'outlet'], function () {
        Route::get( '/',                               ['as' => 'outlet.dasboard',                 'uses' => 'OutletsController@operatorIndex']);
        // Outlet sale routes
        Route::get( 'sales',                           ['as' => 'outlet.sales.index',              'uses' => 'OutletSaleDailiesController@index']);
        Route::post('sales',                           ['as' => 'outlet.sales.store',              'uses' => 'OutletSaleDailiesController@store']);
        Route::get( 'sales/{ocId}',                    ['as' => 'outlet.sales.show',               'uses' => 'OutletSaleDailiesController@show']);
        Route::get( 'sales/{ocId}/delete',             ['as' => 'outlet.sales.delete',             'uses' => 'OutletSaleDailiesController@destroy']);
        Route::get( 'sales/{ocId}/confirm-delete',     ['as' => 'outlet.sales.confirm-delete',     'uses' => 'OutletSaleDailiesController@getModalDelete']);
        // Outlet customer routes
        Route::get( 'customers',                       ['as' => 'outlet.customers.index',          'uses' => 'OutletCustomersController@index']);
        Route::post('customers',                       ['as' => 'outlet.customers.store',          'uses' => 'OutletCustomersController@store']);
        Route::get( 'customers/{ocId}',                ['as' => 'outlet.customers.show',           'uses' => 'OutletCustomersController@show']);
        Route::get( 'customers/{ocId}/delete',         ['as' => 'outlet.customers.delete',         'uses' => 'OutletCustomersController@destroy']);
        Route::get( 'customers/{ocId}/confirm-delete', ['as' => 'outlet.customers.confirm-delete', 'uses' => 'OutletCustomersController@getModalDelete']);
    });

    require __DIR__.'/rapyd.php';
}); // end of AUTHORIZE middleware group
