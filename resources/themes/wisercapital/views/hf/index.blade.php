@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
       
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
                                    <th>Utility</th>
                                    <th>Size Sqft/kW</th>
                                    <th>Status</th>
                                    <th>Data Room</th>
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
        ajax: '{!! route('hf.datatable') !!}',
        columns: [
            { data: 'site_id' },
            { data: 'site_name' },
            { data: null },
            { data: 'address', 
	          "render": function(data, type, address, meta){
			  	return address.site_address + " " + address.site_state;
    		  } 
    		},
            { data: null },
            { data: 'siteArea', 
	          "render": function(data, type, siteArea, meta){
			  	return siteArea.site_area + "/" + siteArea.site_size;
    		  } 
    		},
            { data: null },
			{ data: null }
			
        ]
	    });
	});
	</script>
@endsection
