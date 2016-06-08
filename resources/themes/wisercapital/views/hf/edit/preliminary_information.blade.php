<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="preliminary-project-information-heading">
      <h4 class="panel-title">
 
	    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#preliminary-project-information" aria-expanded="false" aria-controls="preliminary-project-information">
         Preliminary Project Information
        </a>
      </h4>
    </div>
    <div id="preliminary-project-information" class="panel-collapse collapse" role="tabpanel" aria-labelledby="preliminary-project-information-heading">
 
      <div class="panel-body">
      
      
    {!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
    <div class="row">
    	<div class="col-lg-4">
	    	<p class="text-muted">Facility Information</p>
      		<div class="form-group">
	      		{!! Form::label('name', 'Name/Description of the facility/project') !!}
		    	{!! Form::text('name', $site->name, array('class' => 'form-control')) !!}
			</div>
			<div class="form-group">
				{!! Form::label('facility_type', 'Type of Facility') !!}
				{!! Form::select('facility_type', $facility_types, (empty($metas['facility_type']) ? '' : $metas['facility_type']), array('placeholder' => '[Select]', 'id' => 'facility-type', 'class' => 'form-control')) !!}
			</div>
			<div class="form-group">
				{!! Form::label('utility_provider', 'Utility Provider') !!}
		    	{!! Form::select('utility_provider', $utility_providers, (empty($metas['utility_provider']) ? '' : $metas['utility_provider']), array('placeholder' => '[Select]', 'id' => 'utility-provider', 'class' => 'form-control')) !!}
			</div>
      	</div>
      	<div class="col-lg-4">
	      	<p class="text-muted">Meter  Information<button type="button" class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Add a Second Meter</button></p>
      		<div class="form-group">
	      		{!! Form::label('utility_avoided_cost', 'Utility Avoided Cost ($/kWh Rate)') !!}
		  		{!! Form::text('utility_avoided_cost', (isset($metas['utility_avoided_cost']) ? $metas['utility_avoided_cost'] : ''), array('class' => 'form-control')) !!}
			</div>
			<div class="form-group">
				{!! Form::label('energy_yield', 'Energy Yield (kWh/kW/yr DC)') !!}
		  		{!! Form::text('energy_yield', (isset($metas['energy_yield']) ? $metas['energy_yield'] : ''), array('class' => 'form-control')) !!}
		  	</div>
			<div class="form-group">
				{!! Form::label('system_size', 'System Size (kW DC)') !!}
		  		{!! Form::text('system_size', (isset($metas['system_size']) ? $metas['system_size'] : ''), array('class' => 'form-control')) !!}
		   </div>
		</div>
    </div>
    
         
    
    
     <div class="row">
    	<div class="col-lg-4">
	    	<p class="text-muted">System Information</p>
	    	{!! Form::label('system_location', 'System Location') !!}
      		
      		<div class="checkbox">
				<label>
			    	{!! Form::checkbox('system_location[]', 'roof', (isset($metas['system_location']) && in_array('roof', $metas['system_location']))) !!} Roof
				</label>
			</div>
			<div class="checkbox">
				<label>
			    	{!! Form::checkbox('system_location[]', 'ground', (isset($metas['system_location']) && in_array('ground', $metas['system_location']) ? true : false)) !!} Ground
				</label>
			</div>
			<div class="checkbox">
				<label>
			    	{!! Form::checkbox('system_location[]', 'car_port', (isset($metas['system_location']) && in_array('car_port', $metas['system_location']) ? true : false)) !!} Car Port
				</label>
			</div>
			<div class="checkbox">
				<label>
			    	{!! Form::checkbox('system_location[]', 'shade_structure', (isset($metas['system_location']) && in_array('shade_structure', $metas['system_location']) ? true : false)) !!} Shade Structure
				</label>
			</div>
			<div class="checkbox">
				<label>
			    	{!! Form::checkbox('system_location[]', 'other', (isset($metas['system_location']) && in_array('other', $metas['system_location']) ? true : false)) !!} Other
				</label>
			</div>
		</div>
      	<div class="col-lg-4">
	      	<p class="text-muted">&nbsp;</p>
	     	<div class="form-group">
				{!! Form::label('renewable_incentive_program', 'Renewable Incentive Program') !!}
				{!! Form::select('renewable_incentive_program', $renewable_incentive_program, (empty($metas['renewable_incentive_program']) ? '' : $metas['renewable_incentive_program']), array('placeholder' => '[Select]',  'class' => 'form-control')) !!}
			</div>
			<div class="form-group">
				{!! Form::label('interconnection_type', 'Interconection Type') !!}
		    	{!! Form::select('interconnection_type', $interconnection_type, (empty($metas['interconnection_type']) ? '' : $metas['interconnection_type']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			</div>
			<div class="form-group">
	      		{!! Form::label('epc_cost', 'EPC Cost ($/W)') !!}
		    	{!! Form::text('epc_cost', (isset($metas['epc_cost']) ? $metas['epc_cost'] : ''), array('class' => 'form-control')) !!}
			</div>	
		</div>
		<div class="col-lg-4">
			<p class="text-muted">&nbsp;</p>
	    	{!! Form::label('ongoing_system_cost', 'Ongoing System Cost') !!}
      		<div class="checkbox">
	      		<label>
			    	{!! Form::checkbox('ongoing_system_cost[]', 'none', (isset($metas['ongoing_system_cost']) && in_array('none', $metas['ongoing_system_cost']) ? true : false)) !!} None
				</label>
			</div>
			<div class="checkbox">
				<label>
			    	{!! Form::checkbox('ongoing_system_cost[]', 'land_lease', (isset($metas['ongoing_system_cost']) && in_array('land_lease', $metas['ongoing_system_cost']) ? true : false)) !!} Land Lease
				</label>
			</div>
			<div class="checkbox">
				<label>
			    	{!! Form::checkbox('ongoing_system_cost[]', 'property_tax', (isset($metas['ongoing_system_cost']) && in_array('property_tax', $metas['ongoing_system_cost']) ? true : false)) !!} Property Tax 
				</label>
			</div>
			<div class="checkbox">
				<label>
			    	{!! Form::checkbox('ongoing_system_cost[]', 'other', (isset($metas['ongoing_system_cost']) &&  in_array('other', $metas['ongoing_system_cost']) ? true : false)) !!} Other
				</label>
			</div>
		</div>
    </div>
    
        
    <div class="row">
    	<div class="col-lg-4">
	    	<p class="text-muted">Contracting</p>
      		{!! Form::label('signed_power_purchase_agreement', 'Signed Power Purchase Agreement') !!}
      		<div class="radio">
				<label class="checkbox-inline">
			    	{!! Form::radio('signed_power_purchase_agreement', 1, (isset($metas['signed_power_purchase_agreement']) && $metas['signed_power_purchase_agreement'] == 1 ? true : false)) !!}&nbsp; Yes
				</label>
			</div>
			<div class="radio">
				<label class="checkbox-inline">
			    	{!! Form::radio('signed_power_purchase_agreement', 0, (isset($metas['signed_power_purchase_agreement']) && $metas['signed_power_purchase_agreement'] == 0 ? true : false)) !!}&nbsp; No
				</label>
			</div>
        </div>
      	<div class="col-lg-4">
	      	<p class="text-muted">&nbsp;</p>
	  		{!! Form::label('signed_site_lease', 'Signed Site Lease (if not included in PPA)') !!}
      		<div class="radio">
				<label class="checkbox-inline">
			    	{!! Form::radio('signed_site_lease', 1, (isset($metas['signed_site_lease']) && $metas['signed_site_lease'] == 1 ? true : false)) !!}&nbsp; Yes
				</label>
			</div>
			<div class="radio">
				<label class="checkbox-inline">
			    	{!! Form::radio('signed_site_lease', 0, (isset($metas['signed_site_lease']) && $metas['signed_site_lease'] == 0 ? true : false)) !!}&nbsp; No
				</label>
			</div>
		</div>
    </div>
    
    <div class="row">
		<p>&nbsp;</p>
    	<div class="col-lg-4">
	    	<p class="text-muted">Utility Bills</p>
      		<div class="form-group">
	      		{!! Form::label('file_12_months_utility_bill', '12 Months Utility Bills') !!}
	      		<p>{!! Form::label('file_12_months_utility_bill', 'Upload', ['class' => 'btn btn-sm btn-primary btn-file']) !!}</p>
		    	{!! Form::file('file_12_months_utility_bill', ['class' => 'hide']) !!}
			</div>
		</div>
      	<div class="col-lg-4">
	     	<p class="text-muted">Property Information</p>
		 	<div class="form-group">
				{!! Form::label('interest_in_property', 'Interest in Property') !!}
		    	{!! Form::select('interest_in_property', ['option 1' => 'Option 1', 'option 2' => 'Option 2'], (empty($metas['interest_in_property']) ? '' : $metas['interest_in_property']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			</div>
			
	  	</div>
    </div>
    
    
    {!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
	{!! Form::close() !!}
       
       
       
      </div>
    </div>
  </div>
  