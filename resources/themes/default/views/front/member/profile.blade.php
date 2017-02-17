@extends('layouts.store')

@section('content')	
	<section id="cart-view">
		<div class="container">
			<div class="row" style="margin-top:20px;">
				<div class="col-md-3" style="padding:10px;">
					<div class="panel panel-default">
						<div class="panel-body">
							<img width="100%" src="/img/default-avatar.png" alt="profile" class="img-rounded center-block">
						</div>
					</div>
					@if(Auth::user()->id == $id)
						@if($user->hasRole('partners'))
						<div class="panel panel-default">
							<div class="panel-body">
								<h4 class="header-title">Toko</h4>
								<hr>
								<a href="#" class="btn btn-block btn-primary tabs" id="stok">Stok Barang</a>
							</div>
						</div>
						@endif
						<div class="panel panel-default">
							<div class="panel-body">
								<ul class="nav nav-pills nav-stacked">
									<h4 class="header-title">Heading</h4><hr>
									<li><a href="#" class="tabs" id="edit" data-id="{{ $id }}">Edit</a></li>
									@if($user->affiliate)
					    				<li><a href="#" class="tabs" id="aff">Affiliate</a></li>
					    			@endif
									<li><a href="#">Something else</a></li>
								</ul>
							</div>
						</div>
					@endif
				</div>
                <img id="loading" src="http://blog.teamtreehouse.com/wp-content/uploads/2015/05/InternetSlowdown_Day.gif" width="10%" style="display:none;">
				<div class="col-md-9" id="isi" style="padding:10px;">
					<div class="panel panel-default">
						<div class="panel-body">
							<h4>{{ $user->first_name .' '. $user->last_name }}</h4>
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
						</div>
					</div>
				</div>
			</div>
		</div>
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
    var tabClick = function(e, tab) {};
    $(".tabs").on('click', function (event) {
    	event.preventDefault();
    	$("#edit").parent('li').removeClass('active');
    	$("#aff").parent('li').removeClass('active');
    	var id  = $("#edit").data('id');
    	var tab = $(this).attr('id');
        $("#loading").fadeIn();
        $( "#isi" ).empty();
        $.ajax({
            url      : "/member/"+ id +"/"+ tab +"",
            type     : 'GET',
            dataType : 'html',
            success: function(data){
                $("#loading").fadeOut();
                $("#"+tab+"").parent('li').addClass('active');
                $( "#isi" ).append( data );
            }
        });
    });
</script>
@endsection