<?php

namespace App\Http\Controllers;

use App\Repositories\ExpeditionRepository as Expedition;
use App\Repositories\Criteria\Expedition\ExpeditionWhereNameLike;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;

class ExpeditionsController extends Controller
{
    /**
     * @var Expedition
     */
    private $expedition;

    /**
     * @param Expedition $expedition
     */
    public function __construct(Expedition $expedition)
    {
        $this->expedition = $expedition;
    }

    static function routes() {
        \Route::group(['prefix' => 'expeditions'], function () {
            \Route::get(  '/',                     'ExpeditionsController@index')         ->name('admin.expeditions.index');
            \Route::post( '/',                     'ExpeditionsController@store')         ->name('admin.expeditions.store');
            \Route::get(  '/create',               'ExpeditionsController@create')        ->name('admin.expeditions.create');
            \Route::get(  '/search',               'ExpeditionsController@search')        ->name('admin.expeditions.search');
            \Route::get(  '/{exId}',               'ExpeditionsController@show')          ->name('admin.expeditions.show');
            \Route::patch('/{exId}',               'ExpeditionsController@update')        ->name('admin.expeditions.update');
            \Route::get(  '/{exId}/edit',          'ExpeditionsController@edit')          ->name('admin.expeditions.edit');
            \Route::get(  '/{exId}/delete',        'ExpeditionsController@destroy')       ->name('admin.expeditions.delete');
            \Route::get(  '/{exId}/confirm-delete','ExpeditionsController@getModalDelete')->name('admin.expeditions.confirm-delete');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expeditions      = $this->expedition->all();
        $page_title       = trans('admin/expeditions/general.page.index.title');
        $page_description = trans('admin/expeditions/general.page.index.description');

        return view('admin.expeditions.index', compact('expeditions', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title       = trans('admin/expeditions/general.page.create.title');
        $page_description = trans('admin/expeditions/general.page.create.description');

        return view('admin.expeditions.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->expedition->create($data);

        Flash::success( trans('admin/expeditions/general.status.created') );

        return redirect('/admin/expeditions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expedition       = $this->expedition->find($id);
        $page_title       = trans('admin/expeditions/general.page.show.title');
        $page_description = trans('admin/expeditions/general.page.show.description', ['name' => $expedition->name]);

        return view('admin.expeditions.show', compact('page_title', 'page_description', 'expedition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expedition       = $this->expedition->find($id);
        $page_title       = trans('admin/expeditions/general.page.edit.title');
        $page_description = trans('admin/expeditions/general.page.edit.description', ['name' => $expedition->name]);

        return view('admin.expeditions.edit', compact('page_title', 'page_description', 'expedition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_method','_token']);

        $this->expedition->update($data, $id);

        Flash::success( trans('admin/expeditions/general.status.updated') );

        return redirect('/admin/expeditions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->expedition->delete($id);

        Flash::success( trans('admin/expeditions/general.status.deleted') );

        return redirect('/admin/expeditions');
    }

    public function getModalDelete($id)
    {
        $error       = null;
        
        $expedition  = $this->expedition->find($id);
        
        $modal_title = trans('admin/expeditions/dialog.delete-confirm.title');
        $modal_route = route('admin.expeditions.delete', array('id' => $expedition->id));
        $modal_body  = trans('admin/expeditions/dialog.delete-confirm.body', ['id' => $expedition->id, 'full_name' => $expedition->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));
    }

    public function search(Request $request)
    {
        $return_arr  = null;
        
        $query       = $request->input('term');
        
        $expeditions = $this->expedition->pushCriteria(new ExpeditionWhereNameLike($query))->all();

        foreach ($expeditions as $e) {
            $id   = $e->id;
            $name = $e->name;

            $entry_arr    = ['value' => $name];
            $return_arr[] = $entry_arr;
        }

        return $return_arr;
    }
}
