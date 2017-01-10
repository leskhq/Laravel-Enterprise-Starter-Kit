<?php

namespace App\Http\Controllers;

use App\Models\CustomerCandidate;
use App\Repositories\CustomerRepository as Customer;
use App\Repositories\CustomerFollowupRepository as CustomerFollowup;
use App\Repositories\CustomerCandidateFollowupRepository as CandidateFollowup;
use App\Repositories\CustomerCandidateRepository as CustomerCandidateRepo;
use App\Repositories\Criteria\Customer\CustomerCandidateByCreatedAtAscending;
use App\Repositories\Criteria\Customer\CustomerCandidateWithFollowup;
use App\Repositories\Criteria\Customer\CandidateFollowupsByCreatedAtDescending;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Flash;

class CustomerCandidatesController extends Controller
{
    /**
     * @var CustomerCandidateRepo
     */
    protected $customerCandidate;

    /**
     * customer candidate followup alias
     * @var CandidateFollowup
     */
    protected $candidateFollowup;

    /**
     * customer alias
     * @var customer
     */
    protected $customer;

    /**
     * customer followup alias
     * @var customerFollowup
     */
    protected $customerFollowup;

    /**
     * @param CustomerCandidateRepo $customerCandidate
     */
    public function __construct(
        CustomerCandidateRepo $customerCandidate,
        CandidateFollowup $candidateFollowup,
        Customer $customer,
        CustomerFollowup $customerFollowup
        )
    {
        $this->customerCandidate = $customerCandidate;
        $this->candidateFollowup = $candidateFollowup;
        $this->customer          = $customer;
        $this->customerFollowup  = $customerFollowup;
    }

    static function routes() {
        \Route::group(['prefix' => 'customer-candidates'], function () {
            \Route::get(  '/',                     'CustomerCandidatesController@index')         ->name('admin.customer-candidates.index');
            \Route::post( '/',                     'CustomerCandidatesController@store')         ->name('admin.customer-candidates.store');
            \Route::get(  '/create',               'CustomerCandidatesController@create')        ->name('admin.customer-candidates.create');
            \Route::get(  '/{ccId}',               'CustomerCandidatesController@show')          ->name('admin.customer-candidates.show');
            \Route::patch('/{ccId}',               'CustomerCandidatesController@update')        ->name('admin.customer-candidates.update');
            \Route::get(  '/{ccId}/delete',        'CustomerCandidatesController@destroy')       ->name('admin.customer-candidates.delete');
            \Route::get(  '/{ccId}/change',        'CustomerCandidatesController@change')        ->name('admin.customer-candidates.change');
            \Route::get(  '/{ccId}/update-status', 'CustomerCandidatesController@updateStatus')  ->name('admin.customer-candidates.update-status');
            \Route::get(  '/{ccId}/confirm-delete','CustomerCandidatesController@getModalDelete')->name('admin.customer-candidates.confirm-delete');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $customerCandidates = CustomerCandidate::orderBy('created_at', 'asc')
            ->get()
            ->groupBy( function ($date) {
                return Carbon::parse($date->created_at)->format('Y');
            });

        foreach ($customerCandidates as $cc) {
            foreach ($cc as $value) {
                $data[Carbon::parse($value->created_at)->format('Y')]
                     [Carbon::parse($value->created_at)->format('m')]
                     [] = $value;
            }
        }

        $page_title       = trans('admin/customer-candidates/general.page.index.title');
        $page_description = trans('admin/customer-candidates/general.page.index.description');

        return view('admin.customer-candidates.index', compact('page_title', 'page_description', 'customerCandidates', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title       = trans('admin/customer-candidates/general.page.create.title');
        $page_description = trans('admin/customer-candidates/general.page.create.description');

        return view('admin.customer-candidates.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);

        $this->customerCandidate->create($data);

        Flash::success( trans('admin/customer-candidates/general.status.created') );

        return redirect('/admin/customer-candidates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customerCandidate->pushCriteria(new CustomerCandidateWithFollowup())->find($id);

        $followups = $this->candidateFollowup->pushCriteria(new CandidateFollowupsByCreatedAtDescending())->findWhere(['customer_candidate_id' => $id]);

        $page_title = trans('admin/customer-candidates/general.page.show.title');
        $page_description = trans('admin/customer-candidates/general.page.show.description', ['name' => $customer->name]);

        return view('admin.customer-candidates.show', compact('page_title', 'page_description', 'customer', 'followups'));
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

        $this->customerCandidate->update($data, $id);

        Flash::success( trans('admin/customer-candidates/general.status.updated') );

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
        $this->customerCandidate->delete($id);

        Flash::success( trans('admin/customer-candidates/general.status.deleted') );

        return redirect('/admin/customer-candidates');
    }

    public function updateStatus($id)
    {
        $customer = $this->customerCandidate->find($id);

        if ( $customer->status == 1 ) {
            $customer->status = 0;
        } else {
            $customer->status = 1;
        }

        $customer->save();

        Flash::success( trans('admin/customer-candidates/general.status.updated') );

        return redirect('/admin/customer-candidates');
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

        $customerCandidate = $this->customerCandidate->find($id);

        $modal_title = trans('admin/customer-candidates/dialog.delete-confirm.title');
        $modal_route = route('admin.customer-candidates.delete', array('id' => $customerCandidate->id));
        $modal_body  = trans('admin/customer-candidates/dialog.delete-confirm.body', ['id' => $customerCandidate->id, 'full_name' => $customerCandidate->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));
    }

    /**
     * change customer candidate to customer
     * @param  int $id customer candidate id
     * @return response     redirect to customers index
     */
    public function change($id)
    {
        $customer = $this->customerCandidate->find($id);

        $data = [
            'name'    => $customer->name,
            'email'   => $customer->email,
            'phone'   => $customer->phone,
            'address' => $customer->address,
            'type'    => $customer->type
        ];

        $newCustomer = $this->customer->create($data);

        $this->customerFollowup->create([
            'customer_id' => $newCustomer->id,
            'content'     => trans('admin/customer-candidates/general.status.changed')
        ]);

        $this->customerCandidate->delete($id);

        Flash::success( trans('admin/customer-candidates/general.status.updated') );

        return redirect()->route('admin.customers.index', $data['type']);
    }
}
