@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
       
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">System Integrators</h3>
                

                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <table  id="system-integrators-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Organization</th>
                                    <th>Address</th>
                                    <th>Date Approved</th>
                                    <th>Last Login</th>
                                    <th># Active Sites</th>
                                    <th>Active</th>
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
    $('#system-integrators-table').DataTable({
        processing: true,
        serverSide: true,
        "pageLength": 25,
        ajax: '{!! route('si.datatable') !!}',
        columns: [
            { data: 'si_name' },
            { data: null },
            { data: null },
            { data: null },
            { data: null },
            { data: null },
            { data: null }
			
        ]
	    });
	});
	</script>
@endsection