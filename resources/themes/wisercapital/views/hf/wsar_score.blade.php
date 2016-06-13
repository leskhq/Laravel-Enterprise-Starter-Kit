@extends('layouts.master')



<style>


.wsar-score-header
{
	background-color: #e5e5e5;
	color: #404040; 
	padding: 10px 20px;
	    
}

.tooltip-inner {
    max-width: 500px;
    /* If max-width does not work, try using width instead */
    width: 500px; 
	text-align: left !important;
 
}

.glyphicon-ok {color:green;}
.glyphicon-remove {color:red;}
.white {
  color: #e5e5e5;
  background: black;
}
.wsar-score-header .pull-right {vertical-align:middle;}

#wsar-score-wrapper {font-size: 12px; }
</style>
	
 
 
 
 
@section('content')
    <div class="row">
        <div id="wsar-score-wrapper" class="col-lg-8">
        	<p>Wiser's unique rating system illuminates the quality of the sustainable energy investment by quantifying its risk and reward.</p>
			<div class="row">
		        
		         	
		         	
		         	
		         	
		         	@foreach($wsar_score as $key => $section)
		         	
		         	<div class="col-lg-10 col-lg-offset-1">	
		         		<div class="row">
		         			<div class="col-lg-12">
				 				<h3 class="wsar-score-header">{{ ($key) }} 
					 				<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> 
					 				<div class="pull-right wsar-score">{{  ($section['score']) }}/{{  ($section['total_score']) }}</div> 
					 			</h3>  
		         			</div>
				 		</div>
				 		@foreach($section['items'] as $item)
		         			<div class="row">
				         		<div class="col-xs-7 col-lg-7 wsar-description col-lg-offset-1">
						 			{{ ($item['title']) }}
				         		</div>
						 		<div class="col-xs-1 col-lg-1 wsar-status">
						 			<span class="glyphicon glyphicon-{{ ($item['status']) ? 'ok' : 'remove' }}" aria-hidden="true"></span>
						 		</div>
						 		<div class="col-xs-1 col-lg-1 wsar-info">
						 			<span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="right" title="{{ ($item['tooltip']) }}" aria-hidden="true"></span>
						 		</div>
						 		<div class="col-xs-1 col-lg-2 wsar-score">
						 			<div class="wsar-score"><span>{{ ($item['score']) }}</span></div>
						 		</div>		 		
				         	</div>
				         @endforeach
				 	 </div>
		         	@endforeach
		         	
		         	
		         	<div class="col-lg-10 col-lg-offset-1">	
		         		<div class="row">
		         			<div class="col-lg-12">
				 				<h3 class="wsar-score-header">WSAR Score
					 				<div class="pull-right wsar-score">486/100</div> 
					 			</h3>  
		         			</div>
				 		</div>
				 	</div>
		       
		        
		        
		        
    		</div><!-- /.row -->
    		
    		
    		
    		
    		
        </div>
        <div class="col-lg-3 hidden-xs">
			  {!! Html::image('assets/themes/wisercapital/img/WSAR.jpg', 'WSAR Score', array('width' => 70 , 'width' => 290)) !!}
        </div>
	        
        
    </div><!-- /.row -->
    
    
    
    
    
    
    
    
    
    
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <script language="JavaScript">
	    $('.glyphicon-question-sign').tooltip();
        
    </script>
@endsection
