<?php

namespace App\Http\Controllers;

use App\Repositories\OutletRepository as Outlet;
use App\Repositories\UserRepository as User;
use App\Repositories\RoleRepository as Role;
use App\Repositories\Criteria\Outlet\OutletsWithOutletSales;
use App\Repositories\Criteria\Outlet\OutletsWithOutletCustomers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;

class OutletsController extends Controller
{
    private $outlet;

    private $user;

    private $role;

    public function __construct(Outlet $outlet, User $user, Role $role)
    {
        $this->outlet = $outlet;
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = $this->outlet->all();

        $page_title = trans('admin/outlets/general.page.index.title');
        $page_description = trans('admin/outlets/general.page.index.description');

        return view('admin.outlets.index', compact('page_title', 'page_description', 'outlets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = trans('admin/outlets/general.page.create.title');
        $page_description = trans('admin/outlets/general.page.create.description');

        return view('admin.outlets.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data        = $request->all();

        $outletOwner = $this->role->findBy('name', 'outlet-owner');

        $user        = $this->user->find($data['user_id']);

        if (!$user->hasRole('outlet-owner')) {
            $user->attachRole($outletOwner);
        }

        $this->outlet->create($data);

        Flash::success( trans('admin/outlets/general.status.created') );

        return redirect('/admin/outlets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = $this->outlet
            ->pushCriteria(new OutletsWithOutletCustomers())
            ->pushCriteria(new OutletsWithOutletSales())
            ->find($id);

        $page_title = trans('admin/outlets/general.page.show.title');
        $page_description = trans('admin/outlets/general.page.show.description', ['name' => $outlet->name]);

        return view('admin.outlets.show', compact('page_title', 'page_description', 'outlet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = $request->except(['_method', '_token']);

        $this->outlet->update($data, $id);

        Flash::success( trans('admin/outlets/general.status.updated') );

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->outlet->delete($id);

        Flash::success( trans('admin/outlets/general.status.deleted') );

        return redirect('/admin/outlets');
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

        $outlet = $this->outlet->find($id);

        $modal_title = trans('admin/outlets/dialog.delete-confirm.title');
        $modal_route = route('admin.outlets.delete', array('id' => $outlet->id));
        $modal_body = trans('admin/outlets/dialog.delete-confirm.body', ['id' => $outlet->id, 'name' => $outlet->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }
}
