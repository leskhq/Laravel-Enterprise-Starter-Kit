<?php

namespace App\Http\Controllers;

use App\Repositories\OutletSaleDailyRepository as OutletSale;
use App\Repositories\UserRepository as User;
use App\Repositories\Criteria\Outlet\OutletSalesWithOutlets;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Flash;

class OutletSaleDailiesController extends Controller
{
    private $outletSale;

    private $user;

    public function __construct(OutletSale $outletSale, User $user)
    {
        $this->outletSale = $outletSale;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->find(Auth::user()->id);
        dd($user->outlet->id);
        $sales = $this->outletSale->findWhere(['outlet_laundry_id' => $user->outlet->id]);
        $page_title = trans('outlet/sales/general.page.index.title');
        $page_description = trans('outlet/sales/general.page.index.description');

        return view('outlet.sales.index', compact('page_title', 'page_description', 'sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $this->outletSale->create($data);

        Flash::success( trans('outlet/sales/general.status.created') );

        return redirect()->back();
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
        $this->outletSale->delete($id);

        Flash::success( trans('outlet/sales/general.status.deleted') );

        return redirect()->back();
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

        $outletSale = $this->outletSale->pushCriteria(new OutletSalesWithOutlets())->find($id);

        $modal_title = trans('outlet/sales/dialog.delete-confirm.title');
        $modal_route = route('outlet.sales.delete', array('id' => $outletSale->id));
        $modal_body  = trans('outlet/sales/dialog.delete-confirm.body', ['id' => $outletSale->id, 'date' => $outletSale->created_at]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }
}
