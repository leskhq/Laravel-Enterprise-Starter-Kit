<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use AWS;
use Storage;
use Auth;
use App\Repositories\AuditRepository as Audit;
class HFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        
        /*
	        ToDO
	        figure out how to manage title and description
        */
     	   
	   	    
		$page_title = 'LIST OF ALL HOST FACILITIES'; // trans('admin/users/general.page.index.title'); // "Admin | Users";
       $page_description = '';//trans('admin/users/general.page.index.description'); // "List of users";
       return view('hf.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $page_title = 'ADD FACILITY'; // trans('admin/users/general.page.index.title'); // "Admin | Users";
        $page_description = '';//trans('admin/users/general.page.index.description'); // "List of users";
        return view('hf.create', compact('page_title', 'page_description'));
    }

	public function dataTable()
	{
		return Datatables::of(\App\Models\Site::with('user')->get())
			->addColumn('action','<a href="{{ URL::route( "hf.delete", array( $id )) }}">Delete</a> <a href="{{ URL::route( "hf.edit", array( $id )) }}">Edit</a>')
			->editColumn('status', function($data)
				{ 
						
						if($data->status == 0)
							return '<a href="#">Facility Info</a>';
						
				})
			->make(true);
	}
	
	
	public function dataRoom($id)
	{
		$page_title = 'DATA ROOM'; // trans('admin/users/general.page.index.title'); // "Admin | Users";
        $page_description = '';//trans('admin/users/general.page.index.description'); // "List of users";
        $files = Storage::allFiles($id);
		return view('hf.dataroom', compact('page_title', 'page_description', 'files'));
	}
	
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    Audit::log(Auth::user()->id, 'User', 'Created a new Host Facility.', $request->all());
	    $site = \App\Models\Site::create($request->all());
	    return redirect()->route('hf.edit', $site->id);
	    
	    	
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
		Audit::log(Auth::user()->id, 'User', 'Edit Host Facility.', array('id'=>$id));    	
        $page_title = 'Facility Information'; // trans('admin/users/general.page.index.title'); // "Admin | Users";
		$page_description = '';//trans('admin/users/general.page.index.description'); // "List of users";
		return view('hf.edit', compact('page_title', 'page_description'));
		
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
        \App\Models\Site::destroy($id);
         return redirect()->route('hf.index');
    }
}
