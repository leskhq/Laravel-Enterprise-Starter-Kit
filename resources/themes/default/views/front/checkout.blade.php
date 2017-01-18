@extends('layouts.store')

@section('content')

	<!-- Cart view section -->
	<section id="checkout">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="checkout-area">
						<form action="">
						<div class="row">
							<div class="col-md-8">
							</div>
							<div class="col-md-4">
								<div class="checkout-right">
									<h4>Order Summary</h4>
									<div class="aa-order-summary-area">
										<table class="table table-responsive">
											<thead>
												<tr>
													<th>Product</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>T-Shirt <strong> x  1</strong></td>
													<td>$150</td>
												</tr>
												<tr>
													<td>Polo T-Shirt <strong> x  1</strong></td>
													<td>$250</td>
												</tr>
												<tr>
													<td>Shoes <strong> x  1</strong></td>
													<td>$350</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<th>Subtotal</th>
													<td>$750</td>
												</tr>
												<tr>
													<th>Tax</th>
													<td>$35</td>
												</tr>
												<tr>
													<th>Total</th>
													<td>$785</td>
												</tr>
											</tfoot>
										</table>
									</div>
									<h4>Payment Method</h4>
									<div class="aa-payment-method">                    
										<label for="cashdelivery"><input type="radio" id="cashdelivery" name="optionsRadios"> Cash on Delivery </label>
										<label for="paypal"><input type="radio" id="paypal" name="optionsRadios" checked> Via Paypal </label>
										<img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">    
										<input type="submit" value="Place Order" class="aa-browse-btn">                
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / Cart view section -->

@endsection