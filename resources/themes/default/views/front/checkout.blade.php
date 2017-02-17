@extends('layouts.store')

@section('content')

	<!-- Cart view section -->
	<section id="checkout">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="checkout-area">
						<div class="row">
							<div class="col-md-8">
								<div class="checkout-left">
					                <div class="panel-group" id="accordion">
					                    <!-- Coupon section -->
					                    <div class="panel panel-default aa-checkout-coupon">
					                      	<div class="panel-heading">
						                        <h4 class="panel-title">
					                            	Alamat Pengiriman
						                        </h4>
					                      	</div>
					                      	<div id="collapseOne" class="panel-collapse collapse in">
						                        <div class="panel-body">
						                        @if(is_null($user->storeCustomer->address))
						                        	<div class="col-md-6 col-md-offset-3">
							                        	<div class="alert alert-info" role="alert">Anda belum memiliki alamat, silahkan tambahkan alamat baru.</div>
						                        	</div>
						                        	<div class="col-md-12">
	 							                        {!! Form::open(['route' => 'store.add-customer-address', 'class' => 'form-horizontal']) !!}
															<fieldset>
																<div class="form-group">
										                          	{!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!}
										                          	<div class="col-md-4">
											                          	{!! Form::textarea('address', null, ['rows' => 3, 'class' => 'form-control']) !!}
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
									                          	<div class="form-group">
										                          	{!! Form::label('phone', 'Telpon', ['class' => 'col-md-4 control-label']) !!}
										                          	<div class="col-md-4">
										                          		<div class="input-group">
																	      	<span class="input-group-addon">+62</span>
												                          	{!! Form::text('phone', null, ['class' => 'form-control']) !!}
																	    </div>
										                          	</div>
									                          	</div>
									                          	<div class="form-group">
									                          		<div class="col-md-6 col-md-offset-4">
																	    <button type="submit" class="btn btn-primary">Tambah Alamat</button>
																    </div>
																</div>
															</fieldset>
														{!! Form::close() !!}
													</div>
												@else
													{{ $user->storeCustomer->address }} - {{ $user->storeCustomer->phone }}<br>
													<a href="profile">ubah alamat & telepon</a>
												@endif
						                        </div>
					                      	</div>
					                      	<div class="panel-footer">
					                      		<a href="confirmation-order" class="btn btn-default" {{ is_null($user->storeCustomer->address) ? 'disabled':'' }}>Lanjut konfirmasi pesanan</a>
					                      	</div>
					                    </div>
					                </div>
				                </div>
							</div>
							<div class="col-md-4">
								<div class="checkout-left">
									<div class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">Order Summary</h4>
											</div>
											<div class="panel-collapse collapse in">
												<div class="panel-body">
													<div class="aa-order-summary-area">
														<table class="table table-responsive">
															<thead>
																<tr>
																	<th>Product</th>
																	<th>Total</th>
																</tr>
															</thead>
															<tbody>
																@foreach($cart as $value)
																<tr>
																	<td>{{ $value->name }} - ({{ $value->attributes->aroma_name ?: 'polos' }}) <strong> x  {{ $value->quantity }}</strong></td>
																	<td>{{ Helpers::reggo($value->price*$value->quantity) }}</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="panel-footer">
												<table class="table table-responsive">
													<tfoot>
														<tr>
															<th style="border-top:0">Subtotal</th>
															<td style="border-top:0" class="text-right">{{ Helpers::reggo(Cart::getSubTotal()) }}</td>
														</tr>
														<tr>
															<th style="border-top:0">Total</th>
															<td style="border-top:0" class="text-right">{{ Helpers::reggo(Cart::getTotal()) }}</td>
														</tr>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / Cart view section -->

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

		$('.panel-body a input[type=checkbox]').on('click', function(e){
		    e.stopPropagation();
		    $(this).parent().trigger('click');   // <---  HERE
		})
		$('#diffAddress').on('show.bs.collapse', function(e){
		    if( ! $('.panel-body a input[type=checkbox]').is(':checked') )
		    {
		        return false;
		    }
		});
	</script>
@endsection