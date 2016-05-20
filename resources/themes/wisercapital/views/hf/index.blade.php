@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
       
				<p>
					<a href="{{ route('hf.create') }}">
						<button type="button" class="btn btn-primary btn-lg"><span class="fa fa-building" aria-hidden="true"></span> Add Facility</button>
					</a>
				</p>
				
				
                <div class="box box-primary">
	                
	                
                <div class="box-header with-border">
                    <h3 class="box-title">Host Facilities</h3>
					
                </div>
                <div class="box-body">
					
					
                    <div class="table-responsive">
                        <table  id="host-facilities-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>User</th>
                                    <th>Location</th>
                                    <th>Size (kW)</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                      
                    </div> <!-- table-responsive -->

                </div><!-- /.box-body -->
            </div><!-- /.box -->
           
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <script language="JavaScript">
    
    
   	$(function() {
    $('#host-facilities-table').DataTable({
        processing: true,
        serverSide: true,
        "pageLength": 25,
        "scrollX": false,
        ajax: '{!! route('hf.datatable') !!}',
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'user.email' },
            { data: 'address', 
	          "render": function(field, type, data, meta){
		          
		          
			  	return data.address + ", " + data.city + ", " + data.state + " " + data.zip_code;
    		  } 
    		},
            { data: 'area' },
            { data: 'action' },            
            { data: 'status' }
			
        ]
	    });
	});
	</script>
@endsection
