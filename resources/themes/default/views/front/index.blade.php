@extends('layouts.store')

@section('content')

	<!-- Start slider -->
	<section id="aa-slider">
		<div class="aa-slider-area">
			<div id="sequence" class="seq">
				<ul class="seq-canvas">
					<!-- single slide item -->
					<li>
						<div class="seq-model">
							<img data-seq src="https://i.imgsafe.org/79fa5e5f66.jpg" alt="Men slide img" />
						</div>
						<div class="seq-title">
							<span data-seq>Save Up to 75% Off</span>                
							<h2 data-seq>Men Collection</h2>                
							<p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
							<a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
						</div>
					</li>
					<!-- single slide item -->
					<li>
						<div class="seq-model">
							<img data-seq src="https://i.imgsafe.org/79fa5e5f66.jpg" alt="Wristwatch slide img" />
						</div>
						<div class="seq-title">
							<span data-seq>Save Up to 40% Off</span>                
							<h2 data-seq>Wristwatch Collection</h2>                
							<p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
							<a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
						</div>
					</li>
				</ul>
				<!-- slider navigation btn -->
				<!--
				<fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
				  <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
				  <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
				</fieldset>
				-->
			</div>
		</div>
	</section>
	<!-- / slider -->
	<!-- Start Promo section -->
	<section id="aa-promo">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="aa-promo-area">
						<div class="row">
							<!-- promo left -->
							<div class="col-md-5 no-padding">                
								<div class="aa-promo-left">
									<div class="aa-promo-banner">
										<img src="https://i.imgsafe.org/82ecd54f24.jpg" alt="img">                    
										<div class="aa-prom-content">
											<span>75% Off</span>
											<h4><a href="#">For Women</a></h4>                      
										</div>
									</div>
								</div>
							</div>
							<!-- promo right -->
							<div class="col-md-7 no-padding">
								<div class="aa-promo-right">
									<div class="aa-single-promo-right">
										<div class="aa-promo-banner">                      
											<img src="https://i.imgsafe.org/82f036f033.jpg" alt="img">                      
											<div class="aa-prom-content">
												<span>Exclusive Item</span>
												<h4><a href="#">For Men</a></h4>                        
											</div>
										</div>
									</div>
									<div class="aa-single-promo-right">
										<div class="aa-promo-banner">                      
											<img src="https://i.imgsafe.org/82f036f033.jpg" alt="img">                      
											<div class="aa-prom-content">
												<span>Sale Off</span>
												<h4><a href="#">On Shoes</a></h4>                        
											</div>
										</div>
									</div>
									<div class="aa-single-promo-right">
										<div class="aa-promo-banner">                      
											<img src="https://i.imgsafe.org/82f036f033.jpg" alt="img">                      
											<div class="aa-prom-content">
												<span>New Arrivals</span>
												<h4><a href="#">For Kids</a></h4>                        
											</div>
										</div>
									</div>
									<div class="aa-single-promo-right">
										<div class="aa-promo-banner">                      
											<img src="https://i.imgsafe.org/82f036f033.jpg" alt="img">                      
											<div class="aa-prom-content">
												<span>25% Off</span>
												<h4><a href="#">For Bags</a></h4>                        
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
	<!-- / Promo section -->
	<!-- Products section -->
	<section id="aa-product">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="aa-product-area">
							<div class="aa-product-inner">
								<!-- start prduct navigation -->
								<ul class="nav nav-tabs aa-products-tab">
									@foreach($node->getDescendants() as $descendant)
										<li class="{{ $descendant->slug == 'detergent' ? 'active':''}}"><a href="#{{ $descendant->slug }}" data-toggle="tab">{{ $descendant->name }}</a></li>
									@endforeach
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									@foreach($node->getDescendants() as $descendant)
										<!-- Start men product category -->
										<div class="tab-pane fade {{ $descendant->slug == 'detergent' ? 'in active':''}}" id="{{ $descendant->slug }}">
											<ul class="aa-product-catg">
											@foreach($descendant->products->take(4) as $product)
												<!-- start single product item -->
												<li>
													<figure>
														<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
														<a class="aa-add-card-btn" href="{{ route('store.product-modal', $product->id) }}" data-toggle="modal" data-target="#quick-view-modal">
															<span class="fa fa-shopping-cart"></span>Lihat Produk
														</a>
														<figcaption>
															<h4 class="aa-product-title"><a href="#">{{ $product->name }}</a></h4>
															<span class="aa-product-price">{{ Helpers::reggo($product->price) }}</span><span class="aa-product-price"><del>$65.50</del></span>
														</figcaption>
													</figure>
													<!-- product badge -->
													{{-- <span class="aa-badge aa-sale" href="#">SALE!</span> --}}
												</li>
											@endforeach
											</ul>
											<a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
										</div>
										<!-- / men product category -->
									@endforeach
								</div>
								<!-- quick view modal -->                  
								<div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">

										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div>
								<!-- / quick view modal -->              
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / Products section -->
	<!-- banner section -->
	<section id="aa-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">        
					<div class="row">
						<div class="aa-banner-area">
							<a href="#"><img src="https://i.imgsafe.org/830d00d6a4.jpg" alt="fashion banner img"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / banner section -->
	<!-- Support section -->
	<section id="aa-support">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="aa-support-area">
						<!-- single support -->
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="aa-support-single">
								<span class="fa fa-truck"></span>
								<h4>FREE SHIPPING</h4>
								<P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
							</div>
						</div>
						<!-- single support -->
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="aa-support-single">
								<span class="fa fa-clock-o"></span>
								<h4>30 DAYS MONEY BACK</h4>
								<P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
							</div>
						</div>
						<!-- single support -->
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="aa-support-single">
								<span class="fa fa-phone"></span>
								<h4>SUPPORT 24/7</h4>
								<P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / Support section -->

@endsection

@section('bottom_scripts')
@endsection