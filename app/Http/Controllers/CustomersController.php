<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository as Customer;
use App\Repositories\Criteria\Customer\CustomerByCreatedDescending;
use App\Repositories\Criteria\Customer\CustomerWithFollowup;
use App\Repositories\Criteria\Customer\CustomerWhereNameLike;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Helpers;
use Flash;

class CustomersController extends Controller
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexByType($id)
    {
        $customers = $this->customer->pushCriteria(new CustomerByCreatedDescending())->findWhere(['type' => $id]);

        $type = Helpers::getCustomerTypeDisplayName($id);

        $page_title = trans('admin/customers/general.page.index.title');
        $page_description = trans('admin/customers/general.page.index.description', ['type' => $type]);

        return view('admin/customers/index', compact('customers', 'page_title', 'page_description'));
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
        $data = $request->except('_token');

        $this->customer->create($data);

        Flash::success( trans('admin/customers/general.status.created') );

        return redirect()->route('admin.customers.index', $data['type']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customer->pushCriteria(new CustomerWithFollowup())->find($id);

        $page_title = trans('admin/customers/general.page.show.title');
        $page_description = trans('admin/customers/general.page.show.description', ['name' => $customer->name]);

        return view('admin.customers.show', compact('customer', 'page_title', 'page_description'));
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
        $data = $request->except(['_token', '_method']);

        $this->customer->update($data, $id);

        Flash::success( trans('admin/customers/general.status.updated') );

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
        $this->customer->delete($id);

        Flash::success( trans('admin/customers/general.status.deleted') );

        return redirect()->route('admin.customers.index', 1);
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

        $customer = $this->customer->find($id);

        $modal_title = trans('admin/customers/dialog.delete-confirm.title');
        $modal_route = route('admin.customers.delete', array('id' => $customer->id));
        $modal_body = trans('admin/customers/dialog.delete-confirm.body', ['id' => $customer->id, 'full_name' => $customer->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    public function updateStatus($id)
    {
        $customer = $this->customer->find($id);

        if ( $customer->status == 1 ) {
            $customer->status = 0;
        } else {
            $customer->status = 1;
        }

        $customer->save();

        Flash::success( trans('admin/customers/general.status.updated') );

        return redirect()->route('admin.customers.index', $customer->type);
    }

    public function search(Request $request) {
      $return_arr = null;

      $query = $request->input('term');

      $customers = $this->customer->pushCriteria(new CustomerWhereNameLike($query))->all();

      foreach ($customers as $c) {
        $id              = $c->id;
        $name            = $c->name;
        $address         = $c->address;
        $laundry_address = $c->laundry_address;
        $phone           = $c->phone;
        $type            = $c->type;

        $entry_arr = [
          'id'              => $id,
          'text'            => $name,
          'value'           => $name,
          'type'            => $type,
          'phone'           => $phone,
          'address'         => $address,
          'laundry_address' => $laundry_address
        ];
        $return_arr[] = $entry_arr;
      }

      return $return_arr;
    }
}
