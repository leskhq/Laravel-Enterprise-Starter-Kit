@extends('layouts.master')

@section('content')


<style>
.hexagon {
  position: relative;
  width: 110px; 
  height: 63.51px;
  background-color: #666A9E;
  margin: 31.75px 0;
}

.hexagon:before,
.hexagon:after {
  content: "";
  position: absolute;
  width: 0;
  border-left: 55px solid transparent;
  border-right: 55px solid transparent;
}

.hexagon:before {
  bottom: 100%;
  border-bottom: 31.75px solid #666A9E;
}

.hexagon:after {
  top: 100%;
  width: 0;
  border-top: 31.75px solid #666A9E;
}
</style>
	
 



<div class="row">
		  <div class="col-xs-2">
		  <div class="hexagon"></div>
		  </div>
		  <div class="col-xs-2">
		 <div class="hexagon"></div>  </div>
		 <div class="col-xs-2">
		 <div class="hexagon"></div> 
		 </div>
		
		 <div class="col-xs-2">
		 <div class="hexagon"></div> 
		 </div>
		
		 <div class="col-xs-2">
		 <div class="hexagon"></div> 
		 </div>
		
		 <div class="col-xs-2">
		 <div class="hexagon"></div> 
		 </div>
		
		  
		</div>	 <!-- row --> 
		
		
		<br />
		<br />
		

<div class='row'>
	<div class='col-md-12'>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			@include('hf.edit.preliminary_information')
			@include('hf.edit.financials')
			@include('hf.edit.roof_building')
			@include('hf.edit.property_business')
			@include('hf.edit.equipment')
			@include('hf.edit.solar_installer')
			@include('hf.edit.OM')
			@include('hf.edit.project_development')
			@include('hf.edit.system_performance')
			@include('hf.edit.creditworthiness')
			@include('hf.edit.legal_policy')
			@include('hf.edit.servicing_administration')
			@include('hf.edit.first_loss_surely')


		</div>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <script language="JavaScript">
    
    
	</script>
@endsection
