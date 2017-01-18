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
							<form action="">
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
											<tr>
												<td><img src="https://i.imgsafe.org/877ef1a551.png" alt="img"></td>
												<td><a class="aa-cart-title" href="#">Polo T-Shirt</a></td>
												<td>$250</td>
												<td><input class="aa-cart-quantity" type="number" value="1"></td>
												<td>$250</td>
												<td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
											</tr>
											<tr>
												<td><img src="https://i.imgsafe.org/877ef1a551.png" alt="img"></td>
												<td><a class="aa-cart-title" href="#">Polo T-Shirt</a></td>
												<td>$150</td>
												<td><input class="aa-cart-quantity" type="number" value="1"></td>
												<td>$150</td>
												<td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
											</tr>
											<tr>
												<td><img src="https://i.imgsafe.org/877ef1a551.png" alt="img"></td>
												<td><a class="aa-cart-title" href="#">Polo T-Shirt</a></td>
												<td>$50</td>
												<td><input class="aa-cart-quantity" type="number" value="1"></td>
												<td>$50</td>
												<td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
											</tr>
											<tr>
												<td colspan="6" class="aa-cart-view-bottom">
													<div class="aa-cart-coupon">
														<input class="aa-coupon-code" type="text" placeholder="Coupon">
														<input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
													</div>
													<input class="aa-cart-view-btn" type="submit" value="Update Cart">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</form>
							<div class="row">
								<!-- Cart Total view -->
								<div class="col-md-6 col-md-offset-3 text-center">
									<h4 class="text-left">Cart Totals</h4>
									<table class="aa-totals-table">
										<tbody>
											<tr>
												<th>Subtotal</th>
												<td class="text-center">$450</td>
											</tr>
											<tr>
												<th>Total</th>
												<td class="text-center">$450</td>
											</tr>
										</tbody>
									</table>
									<a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
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