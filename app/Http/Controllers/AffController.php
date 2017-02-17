<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Affiliate;
use App\Models\StoreCustomer;
use Auth;
use DB;

use App\Models\Role;

class AffController extends Controller
{
    static function routes() {
        \Route::get('aff/{link}',     'AffController@affClicked');
        \Route::group(['prefix' => 'affiliate'], function () {
            \Route::get(  '/',          'AffController@dashboard')->name('admin.affiliate.dashboard');
            \Route::get(  '/create',    'AffController@create')   ->name('admin.affiliate.create');
            \Route::get(  '/{id}',      'AffController@show')     ->name('admin.affiliate.show');
            \Route::post( '/',          'AffController@store')    ->name('admin.affiliate.store');
        });
    }

    public function dashboard() {
        // get all the affiliator users
        // $affiliators = Role::with('users')->where('name', 'affiliator')->get();
        // $affiliators = Role::where('name', 'affiliator')->first()->users()->get();
        $affiliators = Affiliate::with('user')->get();
        return view('admin.affiliates.dashboard', compact('affiliators'));
    }

    public function affClicked(Request $request, $link) {
        // get visitor ip
        $visitorIp = $request->ip();
        $long = ip2long($visitorIp); // convert it to long so we can store it in database - convert it using long2ip to see the actual ip address
        // try to get ip from database
        $check = DB::table('ip_addresses')->where(['link' => $link, 'ip' => $long])->first();
        // check whether the ip is exists in database or not
        if (null == $check) {
            $saveIp = DB::table('ip_addresses')->insert([
                'ip' => $long,
                'link' => $link
            ]);
            $aff = Affiliate::where('link', $link)->increment('click');
        }
        session()->put('aff_link', $link);
        return redirect('/store');
    }

    public function create() {
        return view('admin.affiliates.create');
    }

    public function show($id) {
        $user = User::find($id);
        return view('admin.affiliates.show', compact('user'));
    }

    public function store(Request $request) {
        // create user
        $user = User::create([
            'first_name' => $request->firstname,
            'last_name'  => $request->lastname,
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => $request->password,
            'enabled'    => true
        ]);

        // assign role affiliator to user
        $user->attachRole(18);

        // get 5 random string
        $arr = str_split('abcdefghijklmnopqrstuvwxyz0123456789'); // get all the characters into an array
        shuffle($arr); // randomize the array
        $arr = array_slice($arr, 0, 5); // get the first six (random) characters out
        $randomStr = implode('', $arr);

        // create affiliate based on user
        $cust = Affiliate::create([
            'user_id' => $user->id,
            'link'    => $randomStr
        ]);

        return redirect('admin/affiliate');
    }
}
