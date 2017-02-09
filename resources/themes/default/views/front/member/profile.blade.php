@extends('layouts.store')

@section('content')

	<!-- catg header banner section -->
	@include('partials.store_banner')
	<!-- / catg header banner section -->
	
	<section id="cart-view">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="cart-view-area">
						<div class="panel panel-default">
						  	<div class="panel-heading">
						    	<h3 class="panel-title">{{ $user->first_name .' '. $user->last_name }}</h3>
						  	</div>
						  	<div class="panel-body">
						    	<div class="row">
						    		<div class="col-md-4">
						    			<img style="width:100%" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" alt="profile" class="img-rounded">
						    		</div>
						    		<div class="col-md-8">
						    			<table class="table">
						    				<tr>
						    					<td>Email</td>
						    					<td>{{ $user->email }}</td>
						    				</tr>
						    				@if($user->hasRole('members'))
						    				<tr>
						    					<td>Phone</td>
						    					<td>{{ $user->storeCustomer->phone or '-' }}</td>
						    				</tr>
						    				<tr>
						    					<td>Address</td>
						    					<td>{{ $user->storeCustomer->address }}</td>
						    				</tr>
						    				@endif
						    			</table>
						    			<a href="#edit-modal" data-toggle="modal" class="btn btn-primary">Edit Profile</a>
						    			@if($user->affiliate)
						    				<a href="#aff-modal" data-toggle="modal" class="btn btn-info">Affiliate</a>
						    			@endif
						    		</div>
						    	</div>
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Edit Modal -->
		<div id="edit-modal" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			      	<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        	<h4 class="modal-title">Perbarui Data</h4>
			      	</div>
			      	<div class="modal-body">
			        	{!! Form::open(['url' => 'updateUser', 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
			      		<fieldset>
			      			@if($user->hasRole('members'))
				        	<div class="form-group">
					        	{!! Form::label('phone', 'Telpon', ['class' => 'col-md-4 control-label']) !!}
					        	<div class="col-md-4">
					        		{!! Form::text('phone', $user->storeCustomer->phone, ['class' => 'form-control']) !!}
				        		</div>
				        	</div>
				        	<div class="form-group">
					        	{!! Form::label('address', 'Alamat', ['class' => 'col-md-4 control-label']) !!}
					        	<div class="col-md-4">
					        		{!! Form::textarea('address', $address, ['rows' => 3, 'class' => 'form-control']) !!}
				        		</div>
				        	</div>
				        	<div class="form-group">
	                      		{!! Form::label('prov', 'Provinsi', ['class' => 'col-md-4 control-label']) !!}
	                      		<div class="col-md-4">
		                          	{!! Form::select('prov', ['default' => 'pilih provinsi'] + $prov, 'default', ['id' => 'prov', 'class' => 'form-control']) !!}
	                          	</div>
	                      	</div>
	                      	<div class="form-group">
	                      		{!! Form::label('kokab', 'Kota Kabupaten', ['class' => 'col-md-4 control-label']) !!}
	                      		<div class="col-md-4">
		                          	{!! Form::select('kokab', ['default' => 'kota'], 'default', ['id' => 'kokab', 'class' => 'form-control']) !!}
	                          	</div>
	                      	</div>
	                      	@endif
	                      	<div class="col-md-4 col-md-offset-3">
				        		<button type="submit" class="btn btn-primary">Update</button>
			        		</div>
                      	</fieldset>
			        	{!! Form::close() !!}
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      	</div>
			    </div>
		  	</div>
		</div>
		@if($user->affiliate)
		<!-- Affiliate Modal -->
		<div id="aff-modal" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			      	<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        	<h4 class="modal-title">Modal Header</h4>
			      	</div>
			      	<div class="modal-body">
			        	<div class="row">
			        		<div class="col-md-6">
			        			your referal link is : <a href="/aff/{{ $user->affiliate->link }}">laundrycleanique.com/aff/{{ $user->affiliate->link }}</a> <br />
				                clicked : {{ $user->affiliate->click }} <br>
				                balance : {{ Helpers::reggo($user->affiliate->balance) }} <br>
				                user registered : {{ $user->affiliate->storeCustomers()->count() }}
			        		</div>
			        	</div>
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      	</div>
			    </div>
		  	</div>
		</div>
		@endif
	</section>

@endsection

@section('bottom_scripts')
<script>
	$("#prov").change(function() {
        $.getJSON("api/get-kokab/" + $("#prov").val(), function(data) {
            var $stations = $("#kokab");
            $stations.empty();
            $.each(data, function(index, value) {
                $stations.append('<option value="' + index +'">' + value + '</option>');
            });
            $("#kota").trigger("change"); /* trigger next drop down list not in the example */
        });
    });
</script>
@endsection