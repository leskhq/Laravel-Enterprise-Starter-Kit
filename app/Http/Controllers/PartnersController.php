<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Partner;
use App\Models\PartnerFee;
use App\Models\Packet;

class PartnersController extends Controller
{
    static function routes() {
        \Route::group(['prefix' => 'partners'], function() {
            \Route::get(    '{id}/type',       'PartnersController@index')     ->name('admin.partners.index');
            \Route::get(    'create',          'PartnersController@create')    ->name('admin.partners.create');
            \Route::post(   'store',           'PartnersController@store')     ->name('admin.partners.store');
            \Route::get(    '{id}/edit',       'PartnersController@edit')      ->name('admin.partners.edit');
            \Route::patch(  '{id}/update',     'PartnersController@update')    ->name('admin.partners.update');
            \Route::delete( '{id}/delete',     'PartnersController@delete')    ->name('admin.partners.delete');
            \Route::get(    'report',          'PartnersController@report')    ->name('admin.partners.report');
            \Route::get(    '{id}',            'PartnersController@show')      ->name('admin.partners.show');
            \Route::post(   'storeFee',        'PartnersController@storeFee')  ->name('admin.partners.store-fee');
            \Route::patch(  '{id}/updateFee',  'PartnersController@updateFee') ->name('admin.partners.update-fee');
            \Route::get(    '{id}/confirm-delete', ['as' => 'admin.partners.confirm-delete', 'uses' => 'PartnersController@confirmDelete']);
        });
    }

    public function index($id) {
        $partners = Partner::where('type', $id)->get();
        $page_description = trans('admin/partners/general.page.index.description');
        return view('admin.partners.index', compact('partners', 'page_description'));
    }

    public function report() {
        $partnerFees = PartnerFee::whereNotNull('settled')->get();
        $totall = 0;
        return view('admin.partners.report', compact('partnerFees', 'totall'));
    }

    public function show($id) {
        $partner = Partner::find($id);
        $page_description = trans('admin/partners/general.page.show.description', ['name' => $partner->name]);
        $packets = \App\Models\Packet::lists('name', 'id')->all();
        return view('admin.partners.show', compact('partner', 'page_description', 'packets'));
    }

    public function create() {
        $modelName = 'partners';
        return view('partials.modals.create_form', compact('modelName'));
    }

    public function store(Request $request) {
        Partner::create($request->all());
        return redirect('admin/partners');
    }

    public function storeFee(Request $request) {
        $input = $request->except(['_method', '_token']);
        if ($input['second_payment'] == '') {
            $input['second_payment'] = null;
        }
        if ($input['settled'] == '') {
            $input['settled'] = null;
        }
        if ($input['addition'] == '') {
            $input['addition'] = null;
        }
        PartnerFee::create($input);
        return redirect()->route('admin.partners.show', $input['partner_id']);
    }

    public function edit($id) {
        $model = Partner::find($id);
        $modelName = 'partners';
        return view('partials.modals.edit_form', compact('model', 'modelName', 'id'));
    }

    public function update(Request $request, $id) {
        Partner::whereId($id)->update($request->except(['_method','_token']));
        return redirect()->route('admin.partners.show', $id);
    }

    public function updateFee(Request $request, $id) {
        $input = $request->except(['_method', '_token']);
        if ($input['second_payment'] == '') {
            $input['second_payment'] = null;
        }
        if ($input['settled'] == '') {
            $input['settled'] = null;
        }
        if ($input['addition'] == '') {
            $input['addition'] = null;
        }
        if ( isset($input['settled']) && $input['settled'] != '' ) {
            Partner::find($id)->update(['active_date' => $input['settled']]);
        }
        PartnerFee::where('partner_id', $id)->update($input);
        return redirect()->route('admin.partners.show', $id);
    }

    public function delete($id) {
        Partner::destroy($id);
    }
}
