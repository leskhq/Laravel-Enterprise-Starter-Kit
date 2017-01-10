<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomerFollowupRepository as CustomerFollowup;
use App\Repositories\Criteria\Customer\FollowupsWithCustomers;
use App\Repositories\Criteria\Customer\CustomerFollowupsByCreatedAtDescending;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use DB;

class CustomerFollowupsController extends Controller
{
    /**
     * @var CustomerFollowup
     */
    protected $customerFollowup;

    /**
     * @param CustomerFollowup $customerFollowup
     */
    public function __construct(CustomerFollowup $customerFollowup)
    {
        $this->customerFollowup = $customerFollowup;
    }

    static function routes() {
        \Route::group(['prefix' => 'customer-followups'], function () {
            \Route::get(  '/',                       'CustomerFollowupsController@index')           ->name('admin.customer-followups.index');
            \Route::post( '/',                       'CustomerFollowupsController@store')           ->name('admin.customer-followups.store');
            \Route::get(  '/{ccfId}/delete',         'CustomerFollowupsController@destroy')         ->name('admin.customer-followups.delete');
            \Route::post( '/select-by-type',         'CustomerFollowupsController@selectByType')    ->name('admin.customer-followups.select-by-type');
            \Route::get(  '/{ccfId}/confirm-delete', 'CustomerFollowupsController@getModalDelete')  ->name('admin.customer-followups.confirm-delete');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerFollowups = $this->customerFollowup
            ->pushCriteria(new FollowupsWithCustomers())
            ->pushCriteria(new CustomerFollowupsByCreatedAtDescending())
            ->paginate(15);
        
        $page_title        = trans('admin/customers/followup.page.index.title');
        $page_description  = trans('admin/customers/followup.page.index.description');

        return view('admin.customers.followups-index', compact('customerFollowups', 'page_title', 'page_description'));
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

        $this->customerFollowup->create($data);

        Flash::success( trans('admin/customers/followup.status.created') );

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
        $this->customerFollowup->delete($id);

        Flash::success( trans('admin/customers/followup.status.deleted') );

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
        $error            = null;
        
        $customerFollowup = $this->customerFollowup->find($id);
        
        $modal_title      = trans('admin/customers/followup-dialog.delete-confirm.title');
        
        $modal_route      = route('admin.customer-followups.delete', ['id' => $customerFollowup->id]);
        
        $modal_body       = trans('admin/customers/followup-dialog.delete-confirm.body', 
            [
                'id'        => $customerFollowup->id,
                'full_name' => $customerFollowup->customer->name
            ]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    public function selectByType()
    {
        $type               = $_POST['query'];

        $candidateFollowups = Customer::select(DB::raw('customers.*, count(*) as `aggregate`'))
            ->join('customer_followups', 'customers.id', '=', 'customer_followups.customer_id')
            ->where('customers.type', '=', $type)
            ->groupBy('customer_id')
            ->orderBy('customer_followups.created_at', 'desc')
            ->get();

        return view('admin.customer-candidates.followups-get-by-type', compact('candidateFollowups'));
    }
}
