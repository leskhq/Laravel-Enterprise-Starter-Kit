
<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="system-performance-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#system-performance" aria-expanded="false" aria-controls="system-performance">
			<img src="http://wisercapital.com/images/icons/wsar.png" /> System Performance
        	</a>
        	<div class="pull-right"><span style="font-size: 22px; color: purple;">0</span>/300</div>
      	</h4>
    </div>
    <div id="system-performance" class="panel-collapse collapse" role="tabpanel" aria-labelledby="system-performancet-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			 
			 
		    
		    
			<div class="row">
				<div class="col-lg-6">
					Panel Manufacturer Warranty	
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/50
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Panel Manufacturer Financial Strength	
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/50
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Panel Manufacturer Performance History and Process	
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/30
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Inverter Manufacturer Financial Strength	
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/60
				</div>
			</div>
			
			 
			
			<div class="row">
				<div class="col-lg-6">
					Inverter Warranty	
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/70
				</div>
			</div>
			
		    <div class="row">
				<div class="col-lg-6">
					Project Specific Performance Insurance - Optional		
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/50
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('project_insurance', 'Does this project have Performance Insurance?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('project_insurance', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['project_insurance']) ? '' : $metas['project_insurance']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
		    
				
			</div>
			
			  <div class="row">
				<div class="col-lg-6">
					Rack System & Monitoring Services		
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/40
				</div>
			</div>
			
		    	            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  