@extends('layouts.store')

@section('content')

	<!-- catg header banner section -->
	<section id="aa-catg-head-banner">
		<img src="https://i.imgsafe.org/88394dfb2f.jpg" alt="fashion img">
		<div class="aa-catg-head-banner-area">
			<div class="container">
				<div class="aa-catg-head-banner-content">
					<h2>Confirmation Page</h2>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>                   
						<li class="active">Confirmation Order</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- / catg header banner section -->

	<!-- Cart view section -->
	<section id="cart-view">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="cart-view-area">
						<div class="cart-view-table">
							<div class="col-md-8 col-md-offset-2">
								<div class="panel panel-default">
								  	<div class="panel-body">
								  		<p class="text-center">
									    	Are you sure? <br>
											Alamat: <br>
											{{ Auth::user()->storeCustomer->address }} <br>
											Telpon: <br>
											{{ Auth::user()->storeCustomer->phone }} <br>

											<table>
												<tr>
													<th>Nama</th>
													<th>Jumlah</th>
													<th>Total</th>
												</tr>
									    		@foreach(Cart::getContent() as $value)
												<tr>
													<td>{{ $value->name }}</td>
													<td>{{ $value->quantity }}</td>
													<td>{{ $value->price*$value->quantity }}</td>
												</tr>
									    		@endforeach
												<tr>
													<th colspan="2">Subtotal</th>
													<td>{{ Cart::getSubTotal() }}</td>
												</tr>
												<tr>
													<th colspan="2">Total</th>
													<td>{{ Cart::getTotal() }}</td>
												</tr>
											</table>

									    	<ul class="text-center">
									    		<li>ketentuan</li>
									    	</ul>

									    	<br>

									    	Dengan mengorder pada kami anda menyetujui <a href="#">Syarat & Ketentuan</a> order.
								    	</p>
								    	{!! Form::open(['url' => 'storeOrder', 'method' => 'POST']) !!}
								    	<p class="text-center">
									    	<button type="submit" class="btn btn-info">Place Order</button>
									    </p>
									    {!! Form::close() !!}
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