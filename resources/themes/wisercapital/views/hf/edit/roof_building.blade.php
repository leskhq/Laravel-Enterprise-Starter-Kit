<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="roof-building-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#roof-building" aria-expanded="false" aria-controls="roof-building">
			Roof / Building
        	</a>
      	</h4>
    </div>
    <div id="roof-building" class="panel-collapse collapse" role="tabpanel" aria-labelledby="roof-building-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			    				
				
			<div class="row">
		    	<div class="col-lg-12">
			    	
		      		{!! Form::label('interconnection_study_status', 'What is the status of the interconnection study or agreement?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('interconnection_study_status', 'completed_or_waived', (isset($metas['interconnection_study_status']) && $metas['interconnection_study_status'] == 'completed_or_waived')) !!}&nbsp; Interconnection studies completed or waived by local utility
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('interconnection_study_status', 'waived_or_available', (isset($metas['interconnection_study_status']) && $metas['interconnection_study_status'] == 'waived_or_available')) !!}&nbsp; Interconnection agreements are waived or available and fees are known
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('interconnection_study_status', 'requirements_and_cost_unknown', (isset($interconnection_study_status['interconnection_study_status']) && $metas['interconnection_study_status'] == 'requirements_and_cost_unknown')) !!}&nbsp; Interconnection requirements and costs are unknown
						</label>
					</div>
		        </div>
			</div>

		   <div class="row">
		    	<div class="col-lg-4">
			    	<div class="form-group">
			  			{!! Form::label('roof_material', 'Roof Material') !!}
						<div class="row">
			  				<div class="col-lg-12">
				  				{!! Form::select('roof_material[]', $roof_material, (empty($metas['roof_material']) ? '' : $metas['roof_material']), array('class' => 'form-control select2', 'multiple' => 'multiple', 'size' => 8)) !!}
				  				<span class="help-block">*command click to select multiple items</span>
				  				
			  				</div>				  			
			  			</div>
					</div>	
				</div>			      
				<div class="col-lg-4">
					<div class="form-group">
			  			{!! Form::label('roof_condition', 'Roof Condition') !!}
						<div class="row">
			  				<div class="col-lg-12">
				  				{!! Form::select('roof_condition', $roof_condition, (empty($metas['roof_condition']) ? '' : $metas['roof_condition']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
				  			</div>				  			
			  			</div>
					</div>	
				</div>
		    </div>
		    
		    
		    
		    <div class="row">
		    	<div class="col-lg-12">
			    	
		      		{!! Form::label('support_solar_array', 'Do you have structural drawings or plans that show the building or structure has the structural integrity to support a solar array?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('support_solar_array', 'yes_both', (isset($metas['support_solar_array']) && $metas['support_solar_array'] == 'yes_both')) !!}&nbsp; Yes, both
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('support_solar_array', 'structural_drawing_only', (isset($metas['support_solar_array']) && $metas['support_solar_array'] == 'structural_drawing_only')) !!}&nbsp; I have structural drawings only
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('support_solar_array', 'plans_only', (isset($interconnection_study_status['support_solar_array']) && $metas['support_solar_array'] == 'plans_only')) !!}&nbsp; I have plans only
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('support_solar_array', 'none', (isset($interconnection_study_status['support_solar_array']) && $metas['support_solar_array'] == 'none')) !!}&nbsp; None
						</label>
					</div>
		        </div>
			</div>
			
			
		     <div class="row">
		    	<div class="col-lg-4">
			    	<div class="form-group">
						{!! Form::label('roof_installed_year', 'When was the roof installed?') !!}
						{!! Form::select('roof_installed_year', $roof_year, (empty($metas['roof_installed_year']) ? '' : $metas['roof_installed_year']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
					</div>
				</div>
		      	<div class="col-lg-4">
			      	<div class="form-group">
						{!! Form::label('roof_work_done_year', 'When was any roof work last done?') !!}
				  		{!! Form::select('roof_work_done_year', $roof_year, (empty($metas['roof_installed_year']) ? '' : $metas['roof_installed_year']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
				   </div>
				</div>
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
						{!! Form::label('certified_roofing_study_remaining_life_year', 'Certified Roofing study indicates remaining life of roof to be?') !!}
						<div class="row">
			  				<div class="col-lg-4">
				  				{!! Form::number('certified_roofing_study_remaining_life_year', (isset($metas['certified_roofing_study_remaining_life_year']) ? $metas['certified_roofing_study_remaining_life_year'] : ''), ['id'=> 'certified-roofing-study', 'class' => 'form-control']) !!}
				  			</div>
				  			<div class="col-lg-3">
				  					{!! Form::checkbox('certified_roofing_study_remaining_life_year', 'not_yet_completed', (isset($metas['certified_roofing_study_remaining_life_year']) && $metas['certified_roofing_study_remaining_life_year'] == 'not_yet_completed'), ['id'=> 'certified-roofing-study-checkbox']) !!}&nbsp; Not Yet Completed
			  				</div>
						</div>
					</div>
				</div>		      	 
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-4">
			    	{!! Form::label('roof_warranty', 'Is there a warranty on the roof?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('roof_warranty', 1, (isset($metas['roof_warranty']) && $metas['roof_warranty'] == 1 ? true : false)) !!}&nbsp; Yes
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('roof_warranty', 0, (isset($metas['roof_warranty']) && $metas['roof_warranty'] == 0 ? true : false)) !!}&nbsp; No
						</label>
					</div>
		        </div>
		        <div class="col-lg-8">
			    	{!! Form::label('install_new_roof_to_complete_project', 'Do you need to install a new roof to complete this project?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('install_new_roof_to_complete_project', 1, (isset($metas['install_new_roof_to_complete_project']) && $metas['install_new_roof_to_complete_project'] == 1 ? true : false)) !!}&nbsp; Yes
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('install_new_roof_to_complete_project', 0, (isset($metas['install_new_roof_to_complete_project']) && $metas['install_new_roof_to_complete_project'] == 0 ? true : false)) !!}&nbsp; No
						</label>
					</div>
		        </div>
			</div>
			
			<div class="row">
		    	<div class="col-lg-4">
			    	{!! Form::label('soil_type', 'Soil Type') !!}
			  		{!! Form::select('soil_type', $soil_type, (empty($metas['soil_type']) ? '' : $metas['soil_type']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
		        </div>
		        <div class="col-lg-4">
			    	{!! Form::label('Hydrology_required', 'Hydrology required?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('Hydrology_required', 1, (isset($metas['Hydrology_required']) && $metas['Hydrology_required'] == 1 ? true : false)) !!}&nbsp; Yes
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('Hydrology_required', 0, (isset($metas['Hydrology_required']) && $metas['Hydrology_required'] == 0 ? true : false)) !!}&nbsp; No
						</label>
					</div>
		        </div>
				<div class="col-lg-4">
			    	{!! Form::label('eir_required', 'EIR required?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('eir_required', 1, (isset($metas['eir_required']) && $metas['eir_required'] == 1 ? true : false)) !!}&nbsp; Yes
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('eir_required', 0, (isset($metas['eir_required']) && $metas['eir_required'] == 0 ? true : false)) !!}&nbsp; No
						</label>
					</div>
		        </div>
		    </div>



            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  