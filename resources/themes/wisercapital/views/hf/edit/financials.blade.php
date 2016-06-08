<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="financials-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#financials" aria-expanded="false" aria-controls="financials">
			Financials
        	</a>
      	</h4>
    </div>
    <div id="financials" class="panel-collapse collapse" role="tabpanel" aria-labelledby="financials-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			    <div class="row">
			    	<div class="col-lg-6">
				    	<p class="text-muted">Business Longevity and Lease Term</p>
				    	<div class="form-group">
				  			{!! Form::label('years_in_business', 'How many years has the current business been operational?') !!}
				  			<div class="row">
				  				<div class="col-lg-5">
					  				{!! Form::select('years_in_business', ['0-5' => '0-5', '5-10' => '5-10', '10+' => '10+'], (empty($metas['years_in_business']) ? '' : $metas['years_in_business']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
				  				</div>				  			
				  			</div>
						</div>
					</div>			      
					<div class="col-lg-6">
						<p class="text-muted">&nbsp;</p>
						<div class="form-group">
				  			{!! Form::label('years_in_lease_term', 'How many years in Lease Term?') !!}
							<div class="row">
				  				<div class="col-lg-5">
					  				{!! Form::number('years_in_lease_term', (isset($metas['years_in_lease_term']) ? $metas['years_in_lease_term'] : ''), array('class' => 'form-control')) !!}
				  				</div>				  			
				  			</div>
						</div>	
					</div>
			    </div>
			    
			    <div class="row">
			    	<div class="col-lg-12">
				    	<p class="text-muted">Public Debt Rating</p>
			      		{!! Form::label('public_debt_rating', 'Do you have a public debt rating at or above BBB or BAA by any of the following?') !!}
			      		<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::checkbox('public_debt_rating', 1, (isset($metas['public_debt_rating']) && $metas['public_debt_rating'] == 1 ? true : false)) !!}&nbsp; S&P BBB or better
							</label>
						</div>
						<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::checkbox('public_debt_rating', 0, (isset($metas['public_debt_rating']) && $metas['public_debt_rating'] == 0 ? true : false)) !!}&nbsp; Fitch BBB or better
							</label>
						</div>
						<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::checkbox('public_debt_rating', 0, (isset($metas['public_debt_rating']) && $metas['public_debt_rating'] == 0 ? true : false)) !!}&nbsp; Moody's BAA or better
							</label>
						</div>
						<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::checkbox('public_debt_rating', 0, (isset($metas['public_debt_rating']) && $metas['public_debt_rating'] == 0 ? true : false)) !!}&nbsp; No
							</label>
						</div>
			        </div>
			    </div>
			    
			    
			   <div class="row">
					<div class="col-lg-6">
				    	<p class="text-muted">Financials & Tax Returns</p>
			      		<div class="form-group">
				      		{!! Form::label('file_3_years_financials', 'Please upload the past three years of financials. (Max size 40MB)') !!}
				      		<p>{!! Form::label('file_3_years_financials', 'Upload', ['class' => 'btn btn-sm btn-primary btn-file']) !!}</p>
					    	{!! Form::file('file_3_years_financials', ['class' => 'hide']) !!}
						</div>
					</div>
			      	<div class="col-lg-6">
				     	<p class="text-muted">&nbsp;</p>
					 	<div class="form-group">
							{!! Form::label('file_2_years_tax_return', 'Upload 2 years of tax returns or form 990 (Max  size 40MB)') !!}
					    	<p>{!! Form::label('file_2_years_tax_return', 'Upload', ['class' => 'btn btn-sm btn-primary btn-file']) !!}</p>
					    	{!! Form::file('file_2_years_tax_return', ['class' => 'hide']) !!}
						</div>
						
				  	</div>
			    </div>
			   
			   <div class="row">
			    	<div class="col-lg-6">
				    	<p class="text-muted">&nbsp;</p>
				    	<div class="form-group">
				  			{!! Form::label('mortgage_amount', 'Mortgage Amount') !!}
				  			<div class="row">
				  				<div class="col-lg-5">
					  				{!! Form::select('mortgage_amount', $mortgage_amount, (empty($metas['mortgage_amount']) ? '' : $metas['mortgage_amount']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
				  				</div>				  			
				  			</div>
						</div>
					</div>			      
					<div class="col-lg-6">
						<p class="text-muted">&nbsp;</p>
						<div class="form-group">
				  			{!! Form::label('bank', 'Bank') !!}
							<div class="row">
				  				<div class="col-lg-5">
					  				{!! Form::text('bank', (!empty($metas['bank']) ? $metas['bank'] : ''), array('class' => 'form-control')) !!}
				  				</div>				  			
				  			</div>
						</div>	
					</div>
			    </div>


				<div class="row">
			    	<div class="col-lg-4">
				    	<p class="text-muted">Tenants</p>
			      		{!! Form::label('tenants', 'Do you have tenants?') !!}
			      		<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::radio('tenants', 1, (isset($metas['tenants']) && $metas['tenants'] == 1 ? true : false)) !!}&nbsp; Yes
							</label>
						</div>
						<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::radio('tenants', 0, (isset($metas['tenants']) && $metas['tenants'] == 0 ? true : false)) !!}&nbsp; No
							</label>
						</div>
			        </div>
				</div>




				<div id="tenants-container" class="{!! (isset($metas['tenants']) && $metas['tenants'] == 1 ? '' : 'hide' ) !!} row">
					<div class="col-lg-4">
				    	<div class="form-group">
			      		{!! Form::label('how_many_tenants', 'How Many Tenants?') !!}
			      			<div class="row">
				  				<div class="col-lg-8">
				  					{!! Form::number('how_many_tenants', (isset($metas['how_many_tenants']) ? $metas['how_many_tenants'] : ''), array('class' => 'form-control')) !!}
				  				</div>
			      			</div>
						</div>
				    </div>
					<div class="col-lg-4">
				    	{!! Form::label('tentant_meter_in_your_name', 'Is the meter in your name?') !!}
			      		<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::radio('tentant_meter_in_your_name', 1, (isset($metas['tentant_meter_in_your_name']) && $metas['tentant_meter_in_your_name'] == 1 ? true : false)) !!}&nbsp; Yes
							</label>
						</div>
						<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::radio('tentant_meter_in_your_name', 0, (isset($metas['tentant_meter_in_your_name']) && $metas['tentant_meter_in_your_name'] == 0 ? true : false)) !!}&nbsp; No
							</label>
						</div>
			        </div>
			        <div class="col-lg-4">
				    	{!! Form::label('tenant_multiple_meters', 'Are there multiple meters?') !!}
			      		<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::radio('tenant_multiple_meters', 1, (isset($metas['tenant_multiple_meters']) && $metas['tenant_multiple_meters'] == 1 ? true : false)) !!}&nbsp; Yes
							</label>
						</div>
						<div class="radio">
							<label class="checkbox-inline">
						    	{!! Form::radio('tenant_multiple_meters', 0, (isset($metas['tenant_multiple_meters']) && $metas['tenant_multiple_meters'] == 0 ? true : false)) !!}&nbsp; No
							</label>
						</div>
			        </div>
				</div>
				
				
				

			    
            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  