<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerCandidateFollowupRepository as CandidateFollowup;
use App\Repositories\Criteria\Customer\FollowupsWithCandidates;
use App\Repositories\Criteria\Customer\CandidateFollowupsByCreatedAtDescending;
use App\Repositories\Criteria\Customer\CandidateFollowupByCandidateType;

use App\Models\CustomerCandidate;
use App\Models\CustomerCandidateFollowup;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use DB;

class CandidateFollowupsController extends Controller
{
    /**
     * @var CandidateFollowup
     */
    protected $candidateFollowup;

    /**
     * @param CandidateFollowup $candidateFollowup
     */
    public function __construct(CandidateFollowup $candidateFollowup)
    {
        $this->candidateFollowup = $candidateFollowup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidateFollowups = $this->candidateFollowup->pushCriteria(new FollowupsWithCandidates())->pushCriteria(new CandidateFollowupsByCreatedAtDescending())->paginate(15);

        $page_title = trans('admin/customer-candidates/followup.page.index.title');
        $page_description = trans('admin/customer-candidates/followup.page.index.description');

        return view('admin.customer-candidates.followups-index', compact('candidateFollowups', 'page_title', 'page_description'));
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
        $data = $request->except(['_token']);

        $this->candidateFollowup->create($data);

        Flash::success( trans('admin/customer-candidates/followup.status.created') );

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
        $this->candidateFollowup->delete($id);

        Flash::success( trans('admin/customer-candidates/followup.status.deleted') );

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

        $candidateFollowup = $this->candidateFollowup->find($id);

        $modal_title = trans('admin/customer-candidates/followup-dialog.delete-confirm.title');

        $modal_route = route('admin.candidate-followups.delete', array('id' => $candidateFollowup->id));

        $modal_body = trans('admin/customer-candidates/followup-dialog.delete-confirm.body', ['id' => $candidateFollowup->id, 'full_name' => $candidateFollowup->customerCandidate->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    public function selectByType() {
        $type = $_POST['query'];

        $candidateFollowups = CustomerCandidate::select(DB::raw('customer_candidates.*, count(*) as `aggregate`'))
        ->join('customer_candidate_followups', 'customer_candidates.id', '=', 'customer_candidate_followups.customer_candidate_id')
        ->where('customer_candidates.type', '=', $type)
        ->groupBy('customer_candidate_id')
        ->orderBy('customer_candidate_followups.created_at', 'desc')
        ->get();

        return view('admin.customer-candidates.followups-get-by-type', compact('candidateFollowups'));
    }

}
