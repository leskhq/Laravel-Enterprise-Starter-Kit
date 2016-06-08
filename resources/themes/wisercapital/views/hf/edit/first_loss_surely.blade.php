<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="first-loss-surety-heading">
    	<h4 class="panel-title">
        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#first-loss-surety" aria-expanded="false" aria-controls="first-loss-surety">
			<img src="http://wisercapital.com/images/icons/wsar.png" /> First Loss Surety
        	</a>
        	<div class="pull-right"><span style="font-size: 22px; color: purple;">0</span>/50</div>
      	</h4>
    </div>
    <div id="first-loss-surety" class="panel-collapse collapse" role="tabpanel" aria-labelledby="first-loss-surety-heading">
    	<div class="panel-body">
			{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			
			<div class="row">
				<div class="col-lg-6">
					5% First Loss Surety
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
			  			{!! Form::label('supported_by_first_loss_surety', 'Is the project supported by a 5% first loss surety?') !!}
			  			<div class="row">
			  				<div class="col-lg-8">
				  				{!! Form::select('supported_by_first_loss_surety', ['yes' => 'Yes', 'no' => 'No'], (empty($metas['supported_by_first_loss_surety']) ? '' : $metas['supported_by_first_loss_surety']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
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
  