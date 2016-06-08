
<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="project-development-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#project-development" aria-expanded="false" aria-controls="project-development">
			<img src="http://wisercapital.com/images/icons/wsar.png" /> Project Development
        	</a>
        	<div class="pull-right"><span style="font-size: 22px; color: purple;">0</span>/100</div>
      	</h4>
    </div>
    <div id="project-development" class="panel-collapse collapse" role="tabpanel" aria-labelledby="project-development-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			 
			<div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('standardized_documents', 'Standardized Documents') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('standardized_documents', ['yes' => 'Yes', 'yes with negotiated and approved edits' => 'Yes with negotiated and approved edits', 'no' => 'No'], (empty($metas['standardized_documents']) ? '' : $metas['standardized_documents']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/10
				</div>
			</div>
		    
		    
			<div class="row">
				<div class="col-lg-6">
					Project Permitting
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/10
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Utility Interconnection Process
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/10
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Installer work experience, financial standing and insurance	
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/49
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Certified Roofing Study	
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/7
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-lg-6">
					Structural Engineering 
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/5
				</div>
			</div>
			
			
			
			<div class="row">
				<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('waive_structural_review', 'Structural Engineering - Waive Structural Review') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('waive_structural_review', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['waive_structural_review']) ? '' : $metas['waive_structural_review']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
		    
				
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Soil conditions and potential risks		
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/7
				</div>
			</div>
			
		    <div class="row">
				<div class="col-lg-6">
					Interest in Property		
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>		    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/1
				</div>
			</div>
			
			
		    	            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  