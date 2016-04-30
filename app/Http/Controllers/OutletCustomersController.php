<?php

namespace App\Http\Controllers;

use App\Repositories\OutletCustomerRepository as OutletCustomer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Flash;

class OutletCustomersController extends Controller
{
    private $outletCustomer;

    public function __construct(OutletCustomer $outletCustomer)
    {
        $this->outletCustomer = $outletCustomer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = trans('outlet/customers/general.page.create.title');
        $page_description = trans('outlet/customers/general.page.create.description');

        return view('outlet.customers.create', compact('page_title', 'page_description'));
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

        $this->outletCustomer->create($data);

        Flash::success( trans('outlet/customers/general.status.created') );

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
        $customer = $this->outletCustomer->find($id);

        if ($customer->user_id != Auth::user()->id && !Auth::user()->hasRole('admins')) {
            return redirect()->back();
        }

        $page_title = trans('outlet/customers/general.page.show.title');
        $page_description = trans('outlet/customers/general.page.show.description', ['name' => $customer->name]);

        return view('outlet.customers.show', compact('page_title', 'page_description', 'customer'));
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
        $this->outletCustomer->delete($id);

        Flash::success( trans('outlet/customers/general.status.deleted') );

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

        $outletCustomer = $this->outletCustomer->find($id);

        $modal_title = trans('outlet/customers/dialog.delete-confirm.title');
        $modal_route = route('outlet.customers.delete', array('id' => $outletCustomer->id));
        $modal_body = trans('outlet/customers/dialog.delete-confirm.body', ['id' => $outletCustomer->id, 'full_name' => $outletCustomer->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }
}
