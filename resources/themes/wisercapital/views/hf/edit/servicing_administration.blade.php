<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="servicing-administration-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#servicing-administration" aria-expanded="false" aria-controls="servicing-administration">
			<img src="http://wisercapital.com/images/icons/wsar.png" /> Servicing and Administration
        	</a>
        	<div class="pull-right"><span style="font-size: 22px; color: purple;">0</span>/50</div>
      	</h4>
    </div>
    <div id="servicing-administration" class="panel-collapse collapse" role="tabpanel" aria-labelledby="servicing-administration-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			
			
			<div class="row">
				<div class="col-lg-6">
					O&M
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/15
				</div>
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('o&m_experience', 'Does the O&M provider have adequate experience performing maintenance and servicing solar arrays?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('o&m_experience', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['o&m_experience']) ? '' : $metas['o&m_experience']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-lg-6">
					Servicing Risk
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/15
				</div>
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('servicing_risk', 'Does the servicer, cash manager, accounting reporter and contract manager have adequate experience?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('servicing_risk', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['servicing_risk']) ? '' : $metas['servicing_risk']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-lg-6">
					Servicing Risk
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/15
				</div>
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('sequestered_account', 'Is there a lock box account established for payment processing and administration of payments to investors?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('sequestered_account', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['sequestered_account']) ? '' : $metas['sequestered_account']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-lg-6">
					Business Interruption Insurance
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
			  			{!! Form::label('business_interruption_insurance', 'Has Business interruption insurance been secured on behalf of the project investors?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('business_interruption_insurance', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['business_interruption_insurance']) ? '' : $metas['business_interruption_insurance']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			
					    	            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  