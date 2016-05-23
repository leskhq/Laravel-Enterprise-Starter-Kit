<?php

namespace App\Http\Controllers;

use App\Repositories\MaterialRepository as Material;
use App\Repositories\Criteria\Material\MaterialsOutOfStock;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;

class MaterialsController extends Controller
{
    private $material;

    public function __construct(Material $material)
    {
        $this->material = $material;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = $this->material->all();

        $page_title       = trans('admin/materials/general.page.index.title');
        $page_description = trans('admin/materials/general.page.index.description');

        return view('admin.materials.index', compact('page_title', 'page_description', 'materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title       = trans('admin/materials/general.page.create.title');
        $page_description = trans('admin/materials/general.page.create.description');

        return view('admin.materials.create', compact('page_title', 'page_description'));
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

        $this->material->create($data);

        Flash::success( trans('admin/materials/general.status.created') );

        return redirect('/admin/materials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = $this->material->find($id);

        $page_title = trans('admin/materials/general.page.edit.title');
        $page_description = trans('admin/materials/general.page.edit.description');

        return view('admin.materials.edit', compact('page_title', 'page_description', 'material'));
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
        $data = $request->except(['_token', '_method']);

        $this->material->update($data, $id);

        Flash::success( trans('admin/materials/general.status.updated') );

        return redirect('/admin/materials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->material->delete($id);

        Flash::success( trans('admin/materials/general.status.deleted') );

        return redirect('/admin/materials');
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        $error = null;

        $material = $this->material->find($id);

        $modal_title = trans('admin/materials/dialog.delete-confirm.title');
        $modal_route = route('admin.materials.delete', array('id' => $material->id));
        $modal_body  = trans('admin/materials/dialog.delete-confirm.body', ['id' => $material->id, 'name' => $material->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    public function outOfStock()
    {
        $materials = $this->material->pushCriteria(new MaterialsOutOfStock())->all();

        return view('admin.materials.index', compact('materials'));
    }

    public function createSelected(Request $request)
    {
        dd($request->all());
    }
}
