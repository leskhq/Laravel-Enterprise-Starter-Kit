<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="solar-installer-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#solar-installer" aria-expanded="false" aria-controls="solar-installer">
			Solar Installer
        	</a>
      	</h4>
    </div>
    <div id="solar-installer" class="panel-collapse collapse" role="tabpanel" aria-labelledby="solar-installer-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			    				
				            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  