@extends('layouts.store')

@section('content')

	<!-- catg header banner section -->
	<section id="aa-catg-head-banner">
		<img src="https://i.imgsafe.org/88394dfb2f.jpg" alt="fashion img">
		<div class="aa-catg-head-banner-area">
			<div class="container">
				<div class="aa-catg-head-banner-content">
					<h2>Cart Page</h2>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>                   
						<li class="active">Cart</li>
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
							@if(!Cart::isEmpty())
								{!! Form::open(['url' => '/update-cart', 'method' => 'patch']) !!}
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th></th>
													<th>Product</th>
													<th>Price</th>
													<th>Quantity</th>
													<th>Total</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@foreach($cart as $value)
												<tr>
													<td><img src="https://i.imgsafe.org/877ef1a551.png" alt="img"></td>
													<td>
														<a class="aa-cart-title" href="#">{{ $value->name }}</a>
														 ({{ $value->attributes->aroma_name ?: 'polos' }})
													</td>
													<td>{{ Helpers::reggo($value->getPriceWithConditions()) }}</td>
													<td><input name="quantity[{{$value->id}}]" class="aa-cart-quantity" type="number" value="{{ $value->quantity }}"></td>
													<td>{{ Helpers::reggo($value->getPriceSumWithConditions()) }}</td>
													<td><a class="remove" href="{{ route('store.remove-cart-item', $value->id) }}"><fa class="fa fa-close"></fa></a></td>
												</tr>
												@endforeach
												<tr>
													<td colspan="6" class="aa-cart-view-bottom">
														<div class="aa-cart-coupon">
														<input class="aa-coupon-code" type="text" placeholder="Coupon">
														<input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
														</div>
														<button class="aa-cart-view-btn" type="submit">Perbarui Keranjang</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								{!! Form::close() !!}
								<div class="row">
									<!-- Cart Total view -->
									<div class="col-md-6 col-md-offset-3 text-center">
										<a href="/store" class="aa-cart-view-btn">Lanjut Belanja</a>
										<h4 class="text-left">Cart Totals</h4>
										<table class="aa-totals-table">
											<tbody>
												<tr>
													<th>Subtotal</th>
													<td class="text-center">{{ Helpers::reggo(Cart::getSubTotal()) }}</td>
												</tr>
												<tr>
													<th>Total</th>
													<td class="text-center">{{ Helpers::reggo(Cart::getTotal()) }}</td>
												</tr>
											</tbody>
										</table>
										@if(Auth::check())
										<a href="checkout" class="aa-cart-view-btn">Proced to Checkout</a>
										@else
										<p>Anda harus login terlebih dahulu untuk melakukan checkout</p>
										<a href="" data-toggle="modal" data-target="#login-modal" class="aa-cart-view-btn">Login</a>
										@endif
									</div>
								</div>
							@else
								<div class="col-md-6 col-md-offset-3 text-center">
									<h4>Belum ada item di keranjang silahkan</h4>
									<a href="/store" class="aa-cart-view-btn">Belanja</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / Cart view section -->

@endsection