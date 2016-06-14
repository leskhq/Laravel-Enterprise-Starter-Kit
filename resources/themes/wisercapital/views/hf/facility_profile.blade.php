@extends('layouts.master')



<style>

.panel-heading {
	background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #587f94 0%, #7793a5 100%) repeat scroll 0 0;
	color:white !important;
	border-color: #587f94 !important;
	
}
.panel {
	border-color: #587f94 !important;
}



.ppa-summary span
{
	font-size: xx-large;	
	display:block;
	color: #587f94;	
}
.ppa-summary div {
	margin: 10px 0px;
}

.wsar-score {
	margin-top: 65px;
	font-size: 32px;
	
}
.wsar-score span{
	
	font-size: 48px;
	color: #879b6f;
}

.panel {min-height: 355px;}

.wsar-score-panel .panel-body .btn { background:#6A6698; color: white; border:black; }
.basic-information-panel table {width: 100%;}
.basic-information-panel table tr {height:47px;}

</style>

	
 
 
 
 
@section('content')
    <div class="row">
	    <div class="col-lg-6">
	    	<div class="panel panel-default basic-information-panel">
				<div class="panel-heading">
					<h3 class="panel-title">
							Basic Information 
							<div class="pull-right">
								<a href="{{ route('hf.edit', $site->id)}}">
									<button type="button" class="btn btn-xs">Edit</button>
								</a>
							</div>
					</h3>
				</div>
				<div class="panel-body">
					<table>
						<tr>
							<th width="50%">Facility/Project Name</th>
							<td>{{$site->name}}</td>
						</tr>
						<tr>
							<th>Address</th>
							<td>{{$site->address}} <br />{{$site->city}}, {{$site->state}} {{$site->zip_code}}</td>
						</tr>
						<tr>
							<th>Type of Facility</th>
							<td>{{$metas['facility_type'] or 'n/a'}}</td>
						</tr>
						<tr>
							<th>System Size</th>
							<td>{{$metas['system_size'] or 'n/a'}}</td>
						</tr>
						<tr>
							<th>Year 1 Annual Production</th>
							<td>{{$metas['energy_yield'] or 'n/a'}}</td>
						</tr>
						<tr>
							<th>System Location</th>
							<td>
								@if( isset($metas['system_location']) && is_array($metas['system_location']) && count($metas['system_location']))
									{{ implode($metas['system_location'], ', ')}}
								@else
									n/a
								@endif
								</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		
		
		<div class="col-lg-6">
	    	<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
							Map 
							<div class="pull-right">
								<a href="{{ route('hf.edit', $site->id)}}">
									<button type="button" class="btn btn-default btn-xs">Edit</button>
								</a>
							</div>
					</h3>
				</div>
				<div class="panel-body">
					<img width="100%" src="http://maps.google.com/maps/api/staticmap?center=34.4392969,-119.7048868&zoom=18&size=300x165&maptype=satellite&sensor=false&language=&markers=color:red|label:none|34.4392969,-119.7048868" />
				</div>
			</div>
		</div>
	</div><!-- /.row -->
    
    
    
    
    <div class="row">
	    <div class="col-lg-6">
	    	<div class="panel height panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
							PPA Summary
							<div class="pull-right">
								<a href="{{ route('hf.edit', $site->id)}}">
									<button type="button" class="btn btn-default btn-xs">Edit</button>
								</a>
							</div>
					</h3>
				</div>
				<div class="panel-body ppa-summary text-center">
					<div class="col-lg-6">
						<span>11&cent;</span>
						<p class="text-muted">Solar cost per kWh</p>
					</div>
					<div class="col-lg-6">
						<span>25</span>
						<p class="text-muted">Term (years)</p>
					</div>
					<div class="col-lg-6">
						<span>13&cent;</span>
						<p class="text-muted">Avoided Utility Cost per kWh</p>
					</div>
					<div class="col-lg-6">
						<span>0&#37;</span>
						<p class="text-muted">PPA Esclation Rate</p>
					</div>
					<div class="col-lg-6">
						<span>&#36;5,000</span>
						<p class="text-muted">Year 1 Savings</p>
					</div>
				</div>
			</div>
		</div>
		
		
		 <div class="col-lg-6">
	    	<div class="panel panel-default wsar-score-panel">
				<div class="panel-heading">
					<h3 class="panel-title">
							 WSAR Score
							<div class="pull-right">
								<a href="{{ route('hf.edit', $site->id)}}">
									<button type="button" class="btn btn-default btn-xs">Edit</button>
								</a>
							</div>
					</h3>
				</div>
				<div class="panel-body text-center">
					<div class="row">
					
						<div class="hide col-lg-8">
						 	{!! Html::image('assets/themes/wisercapital/img/WSAR.jpg', 'WSAR Score', array('width' => 70 , 'width' => 290)) !!}
						</div>
						<div class="col-lg-12 form-group">
							<div class="wsar-score"><span>0</span>/1000</div>	
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 form-group">
							<a href="{{ route('hf.wsar-score', $site->id)}}"><button type="button" class="btn btn-default btn-lg">Score Breakdown</button></a>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		
		
		
    </div><!-- /.row -->
    
    
    
    
    
    
    
    
    
    
    
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <script language="JavaScript">
	    
        
    </script>
@endsection
