<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="property-business-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#property-business" aria-expanded="false" aria-controls="property-business">
			Property / Business
        	</a>
      	</h4>
    </div>
    <div id="property-business" class="panel-collapse collapse" role="tabpanel" aria-labelledby="property-business-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			   				
			 <div class="row">
				<div class="col-lg-8">
			  		<div class="form-group">
			      		{!! Form::label('parcel_number_legal_description', 'Parcel Number/Legal Description of Property') !!}
			      		{!! Form::textarea('parcel_number_legal_description', (!empty($metas['parcel_number_legal_description']) ? $metas['parcel_number_legal_description'] : ''), array('class' => 'form-control', "rows" => 5)) !!}
			      	</div>
				</div>
		    </div>
		    
			
			<div class="row">
				<div class="col-lg-12">
			    	{!! Form::label('status_project_permit', 'What is the status of the project permits?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('status_project_permit', 'in_hand_with_no_risk_of_delay_denial', (isset($metas['status_project_permit']) && $metas['status_project_permit'] == 'in_hand_with_no_risk_of_delay_denial')) !!}&nbsp; Permits in hand with no risk of delay or denial
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('status_project_permit', 'in_process_but_not_approved', (isset($metas['status_project_permit']) && $metas['status_project_permit'] == 'in_process_but_not_approved')) !!}&nbsp; Permits in process but not yet approved
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('status_project_permit', 'risks_costs_minimal_and_known', (isset($metas['status_project_permit']) && $metas['status_project_permit'] == 'risks_costs_minimal_and_known')) !!}&nbsp; Permit risks and costs are minimal and known
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('status_project_permit', 'issues_unknown_uncertain', (isset($metas['status_project_permit']) && $metas['status_project_permit'] == 'issues_unknown_uncertain')) !!}&nbsp; Permitting issues are unknown or uncertain
						</label>
					</div>
					
		        </div>
		    </div>
			
			<hr />
			<div class="row">
				<div class="col-md-4">
					<h4>Host Facility Primary Contact</h4>
				</div>
				<div class="col-md-4">
					<button type="button" {{ (!empty($metas['host_facility_secondary_contact_name']) ? 'style="display:none;' : '') }} id="toggle-secondary-contact" class="btn btn-primary btn-xs"> Add Secondary Contact</button>
				</div>
				
			</div>
			
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
				  		{!! Form::label('host_facility_primary_contact_name', 'Full Name') !!}
				  		{!! Form::text('host_facility_primary_contact_name', (!empty($metas['host_facility_primary_contact_name']) ? $metas['host_facility_primary_contact_name'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_primary_contact_title', 'Title') !!}
				  		{!! Form::text('host_facility_primary_contact_title', (!empty($metas['host_facility_primary_contact_title']) ? $metas['host_facility_primary_contact_title'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_primary_contact_email', 'Email') !!}
				  		{!! Form::text('host_facility_primary_contact_email', (!empty($metas['host_facility_primary_contact_email']) ? $metas['host_facility_primary_contact_email'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_primary_contact_phone', 'Phone') !!}
				  		{!! Form::text('host_facility_primary_contact_phone', (!empty($metas['host_facility_primary_contact_phone']) ? $metas['host_facility_primary_contact_phone'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_primary_contact_address', 'Address') !!}
				  		{!! Form::textarea('host_facility_primary_contact_address', (!empty($metas['host_facility_primary_contact_address']) ? $metas['host_facility_primary_contact_address'] : ''), array('class' => 'form-control', "rows" => 3)) !!}
					</div>					
			    </div>
			    <div class="col-lg-4" {{ (!empty($metas['host_facility_secondary_contact_name']) ? 'style="display:none;"' : '') }}  id="host-facility-secondary-contact">
					<div class="form-group">
				  		{!! Form::label('host_facility_secondary_contact_name', 'Full Name') !!}
				  		{!! Form::text('host_facility_secondary_contact_name', (!empty($metas['host_facility_secondary_contact_name']) ? $metas['host_facility_secondary_contact_name'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_secondary_contact_title', 'Title') !!}
				  		{!! Form::text('host_facility_secondary_contact_title', (!empty($metas['host_facility_secondary_contact_title']) ? $metas['host_facility_secondary_contact_title'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_secondary_contact_email', 'Email') !!}
				  		{!! Form::text('host_facility_secondary_contact_email', (!empty($metas['host_facility_secondary_contact_email']) ? $metas['host_facility_secondary_contact_email'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_secondary_contact_phone', 'Phone') !!}
				  		{!! Form::text('host_facility_secondary_contact_phone', (!empty($metas['host_facility_secondary_contact_phone']) ? $metas['host_facility_secondary_contact_phone'] : ''), array('class' => 'form-control')) !!}
					</div>
					<div class="form-group">
				  		{!! Form::label('host_facility_secondary_contact_address', 'Address') !!}
				  		{!! Form::textarea('host_facility_secondary_contact_address', (!empty($metas['host_facility_secondary_contact_address']) ? $metas['host_facility_secondary_contact_address'] : ''), array('class' => 'form-control', "rows" => 3)) !!}
					</div>
			    </div>
		    </div>


	 
				
		    
		    
		    
			        
			        
			            
			    
            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  