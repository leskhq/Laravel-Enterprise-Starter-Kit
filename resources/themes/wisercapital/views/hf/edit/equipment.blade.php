<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="equipment-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#equipment" aria-expanded="false" aria-controls="equipment">
			Equipment
        	</a>
      	</h4>
    </div>
    <div id="equipment" class="panel-collapse collapse" role="tabpanel" aria-labelledby="equipment-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			    				
				            
			{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
			{!! Form::close() !!}
    	</div>
    </div>
</div>
  