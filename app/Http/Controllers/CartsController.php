<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartsController extends Controller
{
    static function routes() {
        \Route::group(['prefix' => 'cart'], function () {
            \Route::post('/', 'CartsController@store')->name('store.cart.store');
        });
    }

    public function store(Request $request) {
        dd($request);
        Cart::add([

        ])
    }
}
