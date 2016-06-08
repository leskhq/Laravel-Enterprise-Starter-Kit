<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="legal-policy-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#legal-policy" aria-expanded="false" aria-controls="legal-policy">
			<img src="http://wisercapital.com/images/icons/wsar.png" /> Legal & Policy
        	</a>
        	<div class="pull-right"><span style="font-size: 22px; color: purple;">0</span>/100</div>
      	</h4>
    </div>
    <div id="legal-policy" class="panel-collapse collapse" role="tabpanel" aria-labelledby="legal-policy-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			
			<div class="row">
				<div class="col-lg-6">
					Project fire and casualty risk
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
			  			{!! Form::label('rebuilt_if_casualty', 'Can project be rebuilt if it suffers a casualty?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('rebuilt_if_casualty', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['rebuilt_if_casualty']) ? '' : $metas['rebuilt_if_casualty']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
				
			</div>
			
			
			
			<div class="row">
				<div class="col-lg-6">
					Host fire and casualty insurance
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
			  			{!! Form::label('host_maintain_casualty_insurance', 'Does host maintain fire and casualty insurance with replacement cost & zoning code endorsement?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('host_maintain_casualty_insurance', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['host_maintain_casualty_insurance']) ? '' : $metas['host_maintain_casualty_insurance']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			
			
			<div class="row">
				<div class="col-lg-6">
					Subordination and Non Disturbance Agreement
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/50
				</div>
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('file_subordination_non_disturbance_agreement', 'Subordination and Non Disturbance Agreement (Max size 2MB)') !!}
			  			<div class="row">
			  				<div class="col-lg-12">
				  				
				  				<p>{!! Form::label('file_subordination_non_disturbance_agreement', 'Upload', ['class' => 'btn btn-sm btn-primary btn-file']) !!}</p>
				  				{!! Form::file('file_subordination_non_disturbance_agreement', ['class' => 'hide']) !!}
				  				<p class="text-muted">We accept the following file types gif, jpg, png, jpeg, doc, docx, xls, xlsx, pdf, zip</p>
				  				
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('requirements_for_snda_reviewed_waived_by_wc', 'Requirement for SNDA has been reviewed and waived by WC credit team?') !!}
			  			<div class="row">
			  				<div class="col-lg-4">
				  				{!! Form::select('requirements_for_snda_reviewed_waived_by_wc', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['requirements_for_snda_reviewed_waived_by_wc']) ? '' : $metas['requirements_for_snda_reviewed_waived_by_wc']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					Title Insurance, Lien Rights, Roof penetration insurance
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/20
				</div>
			</div>
			
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('file_title_insurance', 'Title Insurance (Max upload size 2MB)') !!}
			  			<div class="row">
			  				<div class="col-lg-12">
				  				
				  				<p>{!! Form::label('file_title_insurance', 'Upload', ['class' => 'btn btn-sm btn-primary btn-file']) !!}</p>
				  				{!! Form::file('file_title_insurance', ['class' => 'hide']) !!}
				  				<p class="text-muted">We accept the following file types gif, jpg, png, jpeg, doc, docx, xls, xlsx, pdf, zip</p>
				  				
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('file_roof_penetration_warranty', 'Roof Penetration Warranty (Max upload size 2MB)') !!}
			  			<div class="row">
			  				<div class="col-lg-12">
				  				
				  				<p>{!! Form::label('file_roof_penetration_warranty', 'Upload', ['class' => 'btn btn-sm btn-primary btn-file']) !!}</p>
				  				{!! Form::file('file_roof_penetration_warranty', ['class' => 'hide']) !!}
				  				<p class="text-muted">We accept the following file types gif, jpg, png, jpeg, doc, docx, xls, xlsx, pdf, zip</p>
				  				
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-lg-6">
					Public Policy & Rate Risks
				</div>			    
				<div class="col-lg-2">
					<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
				</div>			    
				 <div class="col-lg-2">
					<span class="accordion-wsar-score">0</span>/20
				</div>
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('policy_or_rate_change_could_threaten_ppa_cash_flow', 'Are there Proposed Policy or Rate Changes from State or Local Regulators or Utility that could change or threaten PPA cash flow economics?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('policy_or_rate_change_could_threaten_ppa_cash_flow', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['policy_or_rate_change_could_threaten_ppa_cash_flow']) ? '' : $metas['policy_or_rate_change_could_threaten_ppa_cash_flow']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
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
  