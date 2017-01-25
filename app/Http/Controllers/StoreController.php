<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Perfume;
use Cart;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    static function routes() {
        \Route::patch('update-cart',        'StoreController@updateCart')     ->name('store.update-cart');
        \Route::post( 'cart',                'StoreController@addToCart')     ->name('store.add-to-cart');
        \Route::get(  'removeCartItem/{id}', 'StoreController@removeCartItem')->name('store.remove-cart-item');
        \Route::get(  'store',               'StoreController@storeFront')    ->name('store.front');
        \Route::get(  'cart',                'StoreController@storeCart')     ->name('store.cart');
        \Route::get(  'product-modal/{id}',  'StoreController@productModal')  ->name('store.product-modal');
    }

    public function storeFront() {
        $node = \App\Models\Category::where('slug', 'chemical-laundry')->first();
        // return view('test_custom_variables', compact('node'));
        return view('front.index', compact('node'));
    }

    public function productModal($id) {
        $product = \App\Models\Product::find($id);
        $aroma = \App\Models\Perfume::lists('name', 'id')->all();
        return view('product-modal', compact('product', 'aroma'));
    }

    public function addToCart(Request $request) {
        $product = Product::find($request->product_id);
        Cart::add($product->id . $request->aroma_id, $product->name, $product->price, $request->quantity, [
            'product_id' => $product->id
        ]);
        if ($request->aroma_id != '') {
            $aroma = Perfume::find($request->aroma_id);
            Cart::update($product->id . $request->aroma_id, [
                'attributes' => [
                    'product_id' => $product->id,
                    'aroma_id' => $aroma->id,
                    'aroma_name' => $aroma->name
                ]
            ]);
        }
        return redirect('cart');
    }

    public function updateCart(Request $request) {
        foreach ($request->quantity as $key => $value) {
            Cart::update($key, [
                'quantity' => [
                    'relative' => false,
                    'value' => $value
                ]
            ]);
        }
        return redirect('/cart');
    }

    public function removeCartItem($cartId) {
        Cart::remove($cartId);
        return redirect('cart');
    }

    public function storeCart() {
        $cart = Cart::getContent();
        return view('front.cart', compact('cart'));
    }

    public function checkout() {
        return view('front.checkout');
    }
}
