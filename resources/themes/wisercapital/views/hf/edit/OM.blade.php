<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="om-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#om" aria-expanded="false" aria-controls="om">
			O&M
        	</a>
      	</h4>
    </div>
    <div id="om" class="panel-collapse collapse" role="tabpanel" aria-labelledby="om-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			 
			
			 <div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('project_stage', 'What stage is this project in?') !!}
			  			<div class="row">
			  				<div class="col-lg-4">
				  				{!! Form::select('project_stage', $project_stage, (empty($metas['project_stage']) ? '' : $metas['project_stage']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			      
			</div>
			
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('project_stage', 'Identify any specific labor requirements for O&M labor specifically i.e: IBEW, Prevailing Wage, Davis Bacon Act, etc. for this project?') !!}
			  			<div class="row">
			  				<div class="col-lg-4">
				  				{!! Form::text('o&m_labor_requirement', (isset($metas['o&m_labor_requirement']) ? $metas['o&m_labor_requirement'] : ''), ['class' => 'form-control']) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			      
			</div>
			
			
		    <div class="row">
		    	<div class="col-lg-5">
			    	<div class="form-group">
						{!! Form::label('permanent_fall_protection', 'Is there permanent fall protection installed?') !!}
						<div class="row">
			  				<div class="col-lg-6">
				  				{!! Form::select('permanent_fall_protection', $permanent_fall_protection, (empty($metas['permanent_fall_protection']) ? '' : $metas['permanent_fall_protection']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
		      	<div class="col-lg-5">
			    	<div class="form-group">
						{!! Form::label('trackers', 'Are trackers installed?') !!}
						<div class="row">
			  				<div class="col-lg-6">
				  				{!! Form::select('trackers', $trackers, (empty($metas['trackers']) ? '' : $metas['trackers']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>
			</div>
			
			
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('lift_or_special_equipment_to_service_pv_equipment', 'Describe any Lift or special equipment required in order to service the PV equipment (bucket trucks, scissor lifts, etc)?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::textarea('lift_or_special_equipment_to_service_pv_equipment', (!empty($metas['lift_or_special_equipment_to_service_pv_equipment']) ? $metas['lift_or_special_equipment_to_service_pv_equipment'] : ''), array('class' => 'form-control', "rows" => 3)) !!} 
			  				</div>				  			
			  			</div>
					</div>
				</div>			      
			</div>
			
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('feet_between_each_row', 'How many feet are between each row?') !!}
			  			<div class="row">
			  				<div class="col-lg-4">
				  				{!! Form::text('feet_between_each_row', (isset($metas['feet_between_each_row']) ? $metas['feet_between_each_row'] : ''), ['class' => 'form-control']) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			      
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('site_access_restrictions', 'Please describe any site access restrictions, or other restrictions on when technicians can be present?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::textarea('site_access_restrictions', (!empty($metas['site_access_restrictions']) ? $metas['site_access_restrictions'] : ''), array('class' => 'form-control', "rows" => 3)) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			      
			</div>
			
			
			<div class="row">
		    	<div class="col-lg-5">
			    	{!! Form::label('sprinkler_system', 'Does the building have a sprinkler system?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('sprinkler_system', 1, (isset($metas['sprinkler_system']) && $metas['sprinkler_system'] == 1 ? true : false)) !!}&nbsp; Yes
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('sprinkler_system', 0, (isset($metas['sprinkler_system']) && $metas['sprinkler_system'] == 0 ? true : false)) !!}&nbsp; No
						</label>
					</div>
		        </div>
		      	<div class="col-lg-5">
			  		{!! Form::label('fire_alarms', 'Does the building have fire alarms?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('fire_alarms', 1, (isset($metas['fire_alarms']) && $metas['fire_alarms'] == 1 ? true : false)) !!}&nbsp; Yes
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('fire_alarms', 0, (isset($metas['fire_alarms']) && $metas['fire_alarms'] == 0 ? true : false)) !!}&nbsp; No
						</label>
					</div>
				</div>
		    </div>
		    
		    
		    
		    
		    <div class="row">
		    	<div class="col-lg-5">
			    	{!! Form::label('upgrading_transformers', 'Will you be adding or upgrading a transformer?') !!}
		      		<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('upgrading_transformers', 1, (isset($metas['upgrading_transformers']) && $metas['upgrading_transformers'] == 1 ? true : false)) !!}&nbsp; Yes
						</label>
					</div>
					<div class="radio">
						<label class="checkbox-inline">
					    	{!! Form::radio('upgrading_transformers', 0, (isset($metas['upgrading_transformers']) && $metas['upgrading_transformers'] == 0 ? true : false)) !!}&nbsp; No
						</label>
					</div>
		        </div>
		      	<div class="col-lg-5">
			    	<div class="form-group">
			  			{!! Form::label('substations', 'How many substations on site?') !!}
			  			<div class="row">
			  				<div class="col-lg-5">
				  				{!! Form::select('substations', range(0, 10), (empty($metas['substations']) ? '' : $metas['substations']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			     
		    </div>
		    
		    
		    <div class="row">
		    	<div class="col-lg-12">
			    	<div class="form-group">
			  			{!! Form::label('how_many_rooftops_canopies_carports_will_system_be_installed_across', 'How many rooftops, canopies, or carports will the system be installed across?') !!}
			  			<div class="row">
			  				<div class="col-lg-4">
				  				{!! Form::text('how_many_rooftops_canopies_carports_will_system_be_installed_across', (isset($metas['how_many_rooftops_canopies_carports_will_system_be_installed_across']) ? $metas['how_many_rooftops_canopies_carports_will_system_be_installed_across'] : ''), ['class' => 'form-control']) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			      
			</div>
			
			
			
			 <div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('height_of_fence', 'Height of fence (if applicable)?') !!}
			  			<div class="row">
			  				<div class="col-lg-6">
				  				{!! Form::select('height_of_fence', range(0, 20), (empty($metas['height_of_fence']) ? '' : $metas['height_of_fence']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			     
		    </div>
		    
		     <div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('terrain', 'Describe the terrain') !!}
			  			<div class="row">
			  				<div class="col-lg-6">
				  				{!! Form::select('terrain', $terrain, (empty($metas['terrain']) ? '' : $metas['terrain']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			     
		    </div>
		    
		    <div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('buildings_or_trailers', 'How many buildings or trailers will you be adding for this project?') !!}
			  			<div class="row">
			  				<div class="col-lg-6">
				  				{!! Form::select('buildings_or_trailers', range(0, 10), (empty($metas['buildings_or_trailers']) ? '' : $metas['buildings_or_trailers']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
			  				</div>				  			
			  			</div>
					</div>
				</div>			     
		    </div>
		    
		    
		    <div class="row">
		    	<div class="col-lg-6">
			    	<div class="form-group">
			  			{!! Form::label('type_of_construction', 'What is the primary type of construction of the building?') !!}
			  			<div class="row">
			  				<div class="col-lg-6">
				  				{!! Form::select('type_of_construction', $type_of_construction, (empty($metas['type_of_construction']) ? '' : $metas['type_of_construction']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
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
  