<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Meta;
use App\Models\Site;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use AWS;
use Storage;
use Auth;
use App\Repositories\AuditRepository as Audit;
use URL;
use Html;

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
		return Datatables::of(Site::with('user')->get())
			->addColumn('action','<a href="{{ URL::route( "hf.delete", array( $id )) }}">Delete</a> <a href="{{ URL::route( "hf.edit", array( $id )) }}">Edit</a>')
			->editColumn('status', function($data)
				{ 
					//if($data->status == 0) return '<a href="#">Facility Info</a>';
					return HTML::linkRoute('hf.facility-profile', 'Facility Profile', $data->id, array('class' => ''));
					
					
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
	    $site = Site::create($request->all());
	    $url = URL::route('hf.edit', [$site->id, '#preliminary-project-information']);
	    return redirect()->to($url);
	    
	    	
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
	    $site = Site::find($id);

		$metas = $site->getMeta();
		$facility_types 				= ['commercial' => 'Commercial', 'residential' => 'Residential'];
		$utility_providers 				= ['SCE' => 'SCE', 'PGE' => 'PGE', 'LADWP' => 'LADWP', 'SDG&E' => 'SDG&E', 'Lodi' => 'Lodi', 'other' => 'Other'];
		$renewable_incentive_program 	= ['program 1' => 'program 1', 'program 2' => 'program 2'];
		$interconnection_type			= ['type 1' => 'type 1', 'type 2' => 'type 2'];	
		$mortgage_amount				= [
			'I don\'t know' => 'I don\'t know', 
			'$4.5-$5m' => '$4.5-$5m', 
			'$4-$4.5m' => '$4-$4.5m', 
			'$3.5-$4m' => '$3.5-$4m', 
			'$3-$3.5m' => '$3-$3.5m', 
			'$2.5-$3m' => '$2.5-$3m', 
			'$2-$2.5m' => '$2-$2.5m', 
			'$1.5-$2m' => '$1.5-$2m',
			'$500k-$1m' => '$500k-$1m', 
			'$100k-$500k' => '$100k-$500k',
			'<100k' => '<100k',
			'$0' => '$0',
			'>5m' => '>5m'
		];
		
		$roof_material = [
			'Tar & Gravel' => [
				'heat sealed' => 'Heat Sealed',
				'multi-course tar paper' => 'Multi-course tar paper',
				'liquid coating' => 'Liquid Coating'				
			],
			'Shingle' =>
			[
				'wood shake' => 'Wood Shake',
				'Asphalt Composite' => 'Asphalt Composite',
				'concrete' => "Concrete"
			],
			'Single Membrane' =>
			[
				'naked' => 'Naked',
				'silverized' => 'Silverized'
			],
			'Metal' => 
			[
				'standing seam, stainless or copper' => 'Standing seam, Stainless or copper',
				'galvanized' => 'Galvanized'			],
			'Red Tile' =>
			[
				'single tile' => 'Single tile',
				'double tile' => 'Double tile',
				'multi-course tile' => 'Multi-course tile'
					
			],
			'Not in List?' =>
			[
				'other' => 'Other'	
			]
		];
		
		$roof_condition = [
			'new' => 'New',
			'good' => 'Good',
			'average' => 'Average',
			'bad' => 'Bad',
			'leaky' => 'Leaky'			
		];
		
		$roof_year = [
			'5 year' => '5 years',
			'55 - 60 years ' => '55 - 60 years',
			'50 - 55 years' => '50 - 55 years',
			'45 - 50 years' => '45 - 50 years',
			'40 - 45 years' => '40 - 45 years',
			'35 - 40 years' => '35 - 40 years',
			'30 - 35 years' => '30 - 35 years',
			'25 - 30 years' => '25 - 30 years',
			'20 - 25 years' => '20 - 25 years',
			'15 - 20 years' => '15 - 20 years',
			'10 - 15 years' => '10 - 15 years',
			'5 - 10 years' => '5 - 10 years',
			'> 60 years' => '> 60 years'			
		];
		
		$soil_type = [
			'sandy/clay' => "Sandy/Clay",
			'rocky' => "Rocky",
			'Bedrock' => 'Bedrock',
			'unknown' => 'Unknown'
		];
		
		$project_stage = [
			'engineering' => "Engineering",
			'pre-construction/shovel ready' => "Pre-Construction/Shovel Ready",
			'under construction' => 'Under Construction',
			'operational' => "Operational"				
		];
		
		$permanent_fall_protection = [
			'no' => "No",
			'parapets' => "Parapets",
			'railing with tie-offs' => 'Railing with tie-offs',
			'other' => "Other"
		];
		
		$trackers = [
			'no' => 'No',
			'yes - gear driven' => 'Yes - Gear driven',
			'yes - hydraulic driven' => "Yes - hydraulic driven",
			'other' => "Other"
		];
		
		$terrain = [
			'grassy' => "Grassy",
			'tall weeds' => "Tall weeds",
			'agriculture' => "Agriculture",
			'desert' => "Desert",
			'dirt' => "Dirt",
			'concrete' => 'Concrete'
		];
		
		$type_of_construction = [
			'Frame' => [
				'frame' => 'Frame'				
			],
			'Joisted Masonry' =>
			[
				'masonry/concrete sides with frame roof' => ' Masonry/concrete sides with frame roof'
			],
			'Non-combustible' =>
			[
				'metal walls and roofing' => 'Metal walls and roofing'			
			],
			'Masonry Non-combustible' => 
			[
				'masonry/Concrete walls with metal roof supports. Metal or membrane roof' => 'Masonry/Concrete walls with metal roof supports. Metal or membrane roof',
			],
			'Modified Fire-Restitive' =>
			[
				'materilas have a fire rating of at least 1 hour' => 'Materilas have a fire rating of at least 1 hour'
			],
			'Fire Restistive' =>
			[
				'materials have a fire rating greater than 3 hours' => 'Materials have a fire rating greater than 3 hours'	
			]
		];
		
		
		$type_of_business = [
			'real estate' => "Real Estate",
			'manufacturing' => "Manufacturing",
			'distribution' => "Distribution",
			'agriculture' => "Agriculture",
			'retail' => "Retail",
			'service' => "Service",
			'construction' => "Construction",
			'nonprofit' => "Nonprofit",
			'public entities' => "Public Entities"
			
		];
		Audit::log(Auth::user()->id, 'User', 'Edit Host Facility.', array('id'=>$id));    	
        $page_title = 'Facility Information'; // trans('admin/users/general.page.index.title'); // "Admin | Users";
		$page_description = '';//trans('admin/users/general.page.index.description'); // "List of users";
		return view('hf.edit', compact('page_title', 'page_description', 'site', 'metas', 'facility_types', 'utility_providers', 'renewable_incentive_program', 'interconnection_type', 'mortgage_amount', 
			'roof_material', 'roof_condition', 'roof_year', 'soil_type', 'project_stage', 'permanent_fall_protection', 'trackers', 'terrain', 'type_of_construction', 'type_of_business'));
		
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
	 
        $site = Site::find($id);
        $site->update($request->all());
        
        
     //dd($request->except('name', '_token', '_method'));
     
		$post_metas = collect($request->except('name', '_token', '_method'))->filter(function ($item) {
			return !(empty($item) && ($item !== '0') && ($item !== 0));
		});
	
		/* make sure 0 are not being filtered out */
		
		/*
		$empty_post_metas = collect($request->except('name', '_token', '_method'))->filter(function ($item) {
			return !$item;
		});
		
		
		//$site->unsetMeta(array_keys( $empty_metas->toArray() ));
		
		$metas = $site->getMeta();
		$diff =  array_diff( 
        	array_keys($metas->toArray()),
        	array_keys($post_metas->all())
        	);
		$site->unsetMeta($diff);
	   */
	    
	    foreach($request->except('name', '_token', '_method') as $key => $value)
	    {
		    if (empty($value) && ($value !== '0') && ($value !== 0))
		    {
				$site->unsetMeta($key);
		    }
	    }
	     
	
	    
        $site->setMeta($post_metas->all());
		$site->save();
		return redirect()->route('hf.edit', $site->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Site::destroy($id);
         return redirect()->route('hf.index');
    }
    
    public function WSARScore($id)
    {
	    /*	
	    $meta = new Meta;
		
		$meta->type = 'tooltip';
        $meta->key = 'Standardized Documents Tooltip';
        $meta->value = 'Full credit given when Wiser Capital standard PPA, Site Lease and Option Agreement are used in a transaction.';
        

        $meta->save();
        
        
	    $meta = Meta::where('key', '=', '')->get()->keyBy('value');
	    dd($meta);
	    */
	    
	     
	    
	  
	    
	    $wsar_score = [
		    'Project Development' =>
		    [
			    'score' => rand(0,100),
	    		'total_score' => 100,
	    		'items' =>[
	    			['title' => 'Standardized Documents', 'status' => 1, 'tooltip' => Meta::where('key', '=', 'Standardized Documents')->pluck('value'), 'score' => rand(0,10).'/100'],
					['title' => 'Project Permitting','status' => 0,'tooltip' => Meta::where('key', '=', 'Project Permitting')->pluck('value'),'score' => rand(0,10).'/10'],
					['title' => 'Utility Interconnection Process', 'status' => 0, 'tooltip' => Meta::where('key', '=', 'Utility Interconnection Process')->pluck('value'), 'score' => rand(0,10).'/10'],
					['title' => 'Installer work experience, financial standing and insurance', 'status' => 0, 'tooltip' => Meta::where('key', '=', 'Installer work experience, financial standing and insurance')->pluck('value'), 'score' => rand(0,10).'/49'],
					['title' => 'Certified Roofing Study', 'status' => 0, 'tooltip' => Meta::where('key', '=', 'Certified Roofing Study')->pluck('value'), 'score' => rand(0,10).'/7'],
					['title' => 'Structural Engineering', 'status' => 0, 'tooltip' => Meta::where('key', '=', 'Structural Engineering')->pluck('value'), 'score' => rand(0,10).'/5'],
					['title' => 'Soil conditions and potential risks', 'status' => 0, 'tooltip' => Meta::where('key', '=', 'Soil conditions and potential risks')->pluck('value'), 'score' => rand(0,10).'/7'],
					['title' => 'Interest in Property', 'status' => 0, 'tooltip' => Meta::where('key', '=', 'Interest in Property')->pluck('value'), 'score' => rand(0,10).'/1']
				]
			],
			'System Performance' =>
		    [
			    'score' => rand(0,300),
	    		'total_score' => 300,
	    		'items' =>[
		    		['title'		=> 'Panel Manufacturer Warranty','status' => 1,'tooltip' 	=>Meta::where('key', '=', 'Panel Manufacturer Warranty')->pluck('value'),'score' => rand(0,10).'/50'],
					['title'		=> 'Panel Manufacturer Financial Strength','status' => 0,'tooltip' 	=> Meta::where('key', '=', 'Panel Manufacturer Financial Strength')->pluck('value'),'score' => rand(0,10).'/50'],
					['title'		=> 'Panel Manufacturer Performance History and Process','status' => 0,'tooltip' => Meta::where('key', '=', 'Panel Manufacturer Performance History and Process')->pluck('value'),'score' => rand(0,10).'/30'],
					['title'		=> 'Inverter Manufacturer Financial Strength','status' => 0,'tooltip' => Meta::where('key', '=', 'Inverter Manufacturer Financial Strength')->pluck('value'),'score' => rand(0,10).'/60'],
					['title'		=> 'Inverter Warranty','status' => 0,'tooltip' => Meta::where('key', '=', 'Inverter Warranty')->pluck('value'),'score' => rand(0,10).'/70'],
					['title'		=> 'Project Specific Performance Insurance - Optional','status' => 0,'tooltip' => Meta::where('key', '=', 'Project Specific Performance Insurance - Optional')->pluck('value'),'score' => rand(0,10).'/50'],
					['title'		=> 'Rack System & Monitoring Services','status' => 0,'tooltip' => Meta::where('key', '=', 'Rack System & Monitoring Services')->pluck('value'),'score' => rand(0,10).'/40']						
				]
			],
			'Host Facility Creditworthiness' =>
		    [
			    'score' => rand(0,400),
	    		'total_score' => 400,
	    		'items' =>[
		    		['title'=> 'Business Financial Strength','status' => 1,'tooltip' 	=>Meta::where('key', '=', 'Business Financial Strength')->pluck('value'),'score'=> rand(0,10).'/200'],
					['title'=> 'History & Long Term Viability','status'=> rand(0,1),'tooltip' 	=> Meta::where('key', '=', 'History & Long Term Viability')->pluck('value'),'score'=> rand(0,10).'/100'],
					['title'=> 'Host Facility Savings','status'=> rand(0,1),'tooltip' 	=> Meta::where('key', '=', 'Host Facility Savings')->pluck('value'),'score'=> rand(0,10).'/100']
				]
			],
			'Legal and Policy' =>
		    [
			    'score' => rand(0,100),
	    		'total_score' => 100,
	    		'items' =>[
		    		['title'=> 'Project fire and casualty risk','status' => 1,'tooltip'=>Meta::where('key', '=', 'Project fire and casualty risk')->pluck('value'),'score'=> rand(0,10).'/5'],
					['title'=> 'Host fire and casualty insurance','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', 'Host fire and casualty insurance')->pluck('value'),'score'=> rand(0,10).'/5'],
					['title'=> 'Subordination and Non Disturbance Agreement','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', 'Subordination and Non Disturbance Agreement')->pluck('value'),'score'=> rand(0,10).'/50'],
					['title'=> 'Title Insurance, Lien Rights, Roof penetration insurance','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', 'Title Insurance, Lien Rights, Roof penetration insurance')->pluck('value'),'score'=> rand(0,10).'/20'],
					['title'=> 'Public Policy & Rate Risks','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', 'Public Policy & Rate Risks')->pluck('value'),'score'=> rand(0,10).'/20']
				]
			],
			'Servicing and Administration' =>
		    [
			    'score' => rand(0,50),
	    		'total_score' => 50,
	    		'items' =>[
		    		['title'=> 'O&M','status' => 1,'tooltip'=>Meta::where('key', '=', 'O&M')->pluck('value'),'score'=> rand(0,10).'/15'],
					['title'=> 'Servicing Risk','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', 'Servicing Risk')->pluck('value'),'score'=> rand(0,10).'/15'],
					['title'=> 'Sequestered Account','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', 'Sequestered Account')->pluck('value'),'score'=> rand(0,10).'/10'],
					['title'=> 'Business Interruption Insurance','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', 'Business Interruption Insurance')->pluck('value'),'score'=> rand(0,10).'/10']
				]
			],
			'First Loss Surety' =>
		    [
			    'score' => rand(0,50),
	    		'total_score' => 50,
	    		'items' =>[
		    		['title'=> '5% First Loss Surety','status'=> rand(0,1),'tooltip'=> Meta::where('key', '=', '5% First Loss Surety')->pluck('value'),'score'=> rand(0,10).'/50']
				]
			]
		];
			    
		$page_title = 'WISER SOLAR ASSET RATING'; // trans('admin/users/general.page.index.title'); // "Admin | Users";
        $page_description = '';//trans('admin/users/general.page.index.description'); // "List of users";
        
		return view('hf.wsar_score', compact('page_title', 'page_description','wsar_score'));
		    
    }
    
    public function facilityProfile($id)
    {
	    $site = Site::find($id);
		$metas = $site->getMeta();
		
	    $page_title = 'FACILITY PROFILE'; // trans('admin/users/general.page.index.title'); // "Admin | Users";
        $page_description = '';//trans('admin/users/general.page.index.description'); // "List of users";
        
		return view('hf.facility_profile', compact('page_title', 'page_description', 'site', 'metas'));
    }
}
