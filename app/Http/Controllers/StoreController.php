<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StoreCustomer;
use App\Models\Product;
use App\Models\Perfume;
use App\Models\StoreOrder;
use App\Models\StoreOrderDetail;
use App\Models\Affiliate;
use App\Models\StorePartnerProduct;
use App\User;
use Cart;
use Auth;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    static function routes() {
        \Route::get(  'store',                      'StoreController@storeFront')    ->name('store.front');
        \Route::patch('update-cart',                'StoreController@updateCart')    ->name('store.update-cart');
        \Route::post( 'cart',                       'StoreController@addToCart')     ->name('store.add-to-cart');
        \Route::get(  'removeCartItem/{id}',        'StoreController@removeCartItem')->name('store.remove-cart-item');
        \Route::get(  'cart',                       'StoreController@storeCart')     ->name('store.cart');
        \Route::get(  'product-modal/{id}',         'StoreController@productModal')  ->name('store.product-modal');
        \Route::get(  'api/get-kokab/{id}',         'StoreController@getKokab')      ->name('store.get-kokab');
        \Route::post( 'add-store-customer-address', 'StoreController@addAddress')    ->name('store.add-customer-address');
        \Route::get(  'confirmation-order',         'StoreController@confirmOrder')  ->name('store.confirm-order')      ->middleware('authorize');
        \Route::post( 'storeOrder',                 'StoreController@storeOrder')    ->name('store.store-order')        ->middleware('authorize');
        \Route::get(  'member/{id}',                'StoreController@profile')       ->name('store.profile')            ->middleware('authorize');
        \Route::get(  'member/{id}/{tab}',          'StoreController@profileTab')    ->name('store.profile.tab')        ->middleware('authorize');
        \Route::post( 'update-stock',               'StoreController@updateStock')   ->name('store.update-stock')       ->middleware('authorize');
        \Route::get(  'daftar',                     'StoreController@daftar')        ->name('store.daftar');
        \Route::post( 'postDaftar',                 'StoreController@postDaftar')    ->name('store.postDaftar');
    }

    public function storeFront() {
        // dd(session()->get('aff_id'));
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
        // lets create first our condition instance
        $affCondition = new \Darryldecode\Cart\CartCondition(array(
            'name'   => 'SALE 5% from affiliate',
            'type'   => 'promo',
            'target' => 'item',
            'value'  => '-5%',
        ));

        $product = Product::find($request->product_id); // get product id
        // add product to the cart
        Cart::add(
            $product->id . $request->aroma_id,
            $product->name,
            $product->price,
            $request->quantity, [
                'product_id' => $product->id
            ]
        );
        // check if the product has aroma in it
        if ($request->aroma_id != '') {
            $aroma = Perfume::find($request->aroma_id);
            Cart::update($product->id . $request->aroma_id, [
                'attributes' => [
                    'product_id' => $product->id,
                    'aroma_id'   => $aroma->id,
                    'aroma_name' => $aroma->name
                ]
            ]);
        }
        // apply promo condition on item-base if the user is affilated by affiliator
        if (session('aff_link') != null) {
            Cart::update($request->product_id . $request->aroma_id, [
                'conditions' => $affCondition
            ]);
        } elseif (Auth::user()) {
            if (Auth::user()->storeCustomer->aff_id != null) {
                Cart::update($request->product_id . $request->aroma_id, [
                    'conditions' => $affCondition
                ]);
            }
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
        $cart = Cart::getContent();
        $user = Auth::user();
        $prov = DB::table('master_provinsi')->lists('nama', 'id');
        return view('front.checkout', compact('cart', 'user', 'prov', 'kab'));
    }

    public function getKokab($id) {
        $kab = DB::table('master_kokab')->where('provinsi_id', 'like', $id)->lists('nama', 'id');
        return response()->json($kab);
    }

    public function daftar() {
        return view('auth.register-customer');
    }

    public function postDaftar(Request $request) {
        // create user
        $user = User::create([
            'first_name' => $request->firstname,
            'last_name'  => $request->lastname,
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => $request->password,
            'enabled'    => true
        ]);

        // assign role members to user
        $user->attachRole(19);

        // create store customer based on user
        $cust = StoreCustomer::create([
            'user_id' => $user->id,
        ]);

        // get affiliate id
        $aff  = Affiliate::where('link', $request->aff_link)->first();
        if (!is_null($aff)) { // if affiliate id isn't null
            $cust->update(['aff_id' => $aff->id]); // update the store customer 'aff_id' column
        }
        
        return redirect('store');
    }

    public function profile($id) {
        $user       = User::find($id);

        return view('front.member.profile', compact('id', 'user', 'page_title'));
    }

    public function profileTab($id, $tab) {
        $user = User::find($id);
        if ($tab == 'edit') {
            $prov       = DB::table('master_provinsi')->lists('nama', 'id');
            $address    = '';

            if ($user->hasRole('members')) {
                if ($user->storeCustomer->address != null) {
                    $arr     = explode(',', $user->storeCustomer->address);
                    $address = $arr[0];
                }
            }

            return view('front.member.profile-edit', compact('user', 'prov', 'address'));
        } elseif ($tab == 'aff') {
            return view('front.member.profile-aff', compact('user'));
        } elseif ($user->hasRole('partners') && $tab == 'stok') {
            return view('front.member.profile-stock', compact('user'));
        }
    }

    public function updateStock(Request $request) {
        foreach ($request->stock as $key => $value) {
            StorePartnerProduct::where('store_partner_id', $request->store_partner_id)
                ->where('product_id', $key)
                ->update(['stock' => $value]);
        }
        return redirect( route('store.profile', Auth::user()->id) );
    }

    public function confirmOrder() {
        $cart = Cart::getContent();
        $user = Auth::user();
        return view('front.member.confirm-order', compact('cart', 'user'));
    }

    public function storeOrder() {
        try {
            $total      = Cart::getTotal();
            $storeOrder = StoreOrder::create([
                'store_customer_id' => Auth::user()->storeCustomer->id,
                'address'           => Auth::user()->storeCustomer->address,
                'phone'             => Auth::user()->storeCustomer->phone,
                'total'             => $total
            ]);

            foreach (Cart::getContent() as $key => $value) {
                $storeOrderDetail = StoreOrderDetail::create([
                    'order_id'   => $storeOrder->id,
                    'product_id' => $value->attributes->product_id,
                    'price'      => $value->price,
                    'quantity'   => $value->quantity,
                    'total'      => $value->price*$value->quantity
                ]);
                if ($value->attributes->aroma_name) {
                    StoreOrderDetail::where('order_id', $storeOrderDetail->order_id)
                        ->where('product_id', $storeOrderDetail->product_id)
                        ->update(['description' => $value->attributes->aroma_name]);
                }
            }

            if (Auth::user()->storeCustomer->aff_id != null) {
                $aff = Affiliate::find(Auth::user()->storeCustomer->aff_id);
                $aff->increment('temp_balance', 10/100*$total);
            }
            Cart::clear();
            session()->flush();
            return redirect('store');
        } catch (Exception $e) {
            return redirect('store');
        }
    }

    public function addAddress(Request $request) {
        $customer = StoreCustomer::where('user_id', Auth::user()->id);
        $prov     = DB::table('master_provinsi')->find($request->prov)->nama;
        $kab      = DB::table('master_kokab')->find($request->kokab)->nama;
        $address  = $request->address.','.$prov.','.$kab;
        $customer->update(['address' => $address, 'phone' => $request->phone]);
        return back();
    }
}
