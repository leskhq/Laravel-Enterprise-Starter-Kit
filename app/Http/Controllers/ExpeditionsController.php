<?php

namespace App\Http\Controllers;

use App\Repositories\ExpeditionRepository as Expedition;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expeditions = $this->expedition->all();

        $page_title = trans('admin/expeditions/general.page.index.title');
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
        $page_title = trans('admin/expeditions/general.page.create.title');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expedition = $this->expedition->find($id);

        $page_title = trans('admin/expeditions/general.page.show.title');
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
        $expedition = $this->expedition->find($id);

        $page_title = trans('admin/expeditions/general.page.edit.title');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
