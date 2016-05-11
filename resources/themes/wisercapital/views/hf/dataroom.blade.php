@extends('layouts.master')

@section('head_extra')
    @include('partials._head_extra_jstree_css')
    @include('partials._head_extra_select2_css')
@endsection


@section('content')
    <div class='row'>
        <div class='col-md-12'>
            
            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Room</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
    
	                   <div id="jstree">
						    <!-- in this example the tree is populated from inline HTML -->
						    <ul>
						      <li>Files
						        <ul>
						          @foreach($files as $f)
						          	<li>{{ $f }}</li>
						          @endforeach
						        </ul>
						      </li>
						     
						    </ul>
						  </div>
						  
                </div><!-- /.box-body -->
            </div>
            
            
           
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')

	<script src="{{ asset ("/jstree/dist/jstree.min.js") }}"></script>
	
    <script language="JavaScript">
    	$(function () { 
	    	
	    	$('#jstree').jstree().bind("ready.jstree", function (event, data) {
            // you get two params - event & data - check the core docs for a detailed description
            $(this).jstree("open_all");
        }); 
	    	
    	});
	</script>
@endsection
