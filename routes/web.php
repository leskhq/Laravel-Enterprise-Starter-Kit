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
Route::get('/', 		                         'HomeController@index');
Route::get('index',     ['as' => 'index',     'uses' => 'HomeController@index']);
Route::get('home',      ['as' => 'home',      'uses' => 'HomeController@index']);
Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

///////
// Admin
Route::prefix('admin')->group(function () {
    // Users
    Route::post  ('users',             ['as' => 'admin.users.store',   'uses' => 'UsersController@store'  ]);
    Route::get   ('users',             ['as' => 'admin.users.index',   'uses' => 'UsersController@index'  ]);
    Route::get   ('users/create',      ['as' => 'admin.users.create',  'uses' => 'UsersController@create' ]);
    Route::patch ('users/{user}',      ['as' => 'admin.users.update',  'uses' => 'UsersController@update' ]);
    Route::get   ('users/{user}',      ['as' => 'admin.users.show',    'uses' => 'UsersController@show'   ]);
    Route::delete('users/{user}',      ['as' => 'admin.users.destroy', 'uses' => 'UsersController@destroy']);
    Route::get   ('users/{user}/edit', ['as' => 'admin.users.edit',    'uses' => 'UsersController@edit'   ]);
});