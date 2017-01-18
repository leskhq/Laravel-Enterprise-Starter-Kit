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
									<li class="active"><a href="#men" data-toggle="tab">Men</a></li>
									<li><a href="#women" data-toggle="tab">Women</a></li>
									<li><a href="#sports" data-toggle="tab">Sports</a></li>
									<li><a href="#electronics" data-toggle="tab">Electronics</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<!-- Start men product category -->
									<div class="tab-pane fade in active" id="men">
										<ul class="aa-product-catg">
											<!-- start single product item -->
											<li class="firstt">
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
														<span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
													</figcaption>
												</figure>                        
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-sale" href="#">SALE!</span>
											</li>
										</ul>
										<a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
									</div>
									<!-- / men product category -->
									<!-- start women product category -->
									<div class="tab-pane fade" id="women">
										<ul class="aa-product-catg">
											<!-- start single product item -->
											<li class="firstt">
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">This is Title</a></h4>
														<span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
													</figcaption>
												</figure>                         
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-sale" href="#">SALE!</span>
											</li>
											<!-- start single product item -->
											<li>
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
														<span class="aa-product-price">$45.50</span>
													</figcaption>
												</figure>                         
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-hot" href="#">HOT!</span>
											</li>
										</ul>
										<a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
									</div>
									<!-- / women product category -->
									<!-- start sports product category -->
									<div class="tab-pane fade" id="sports">
										<ul class="aa-product-catg">
											<!-- start single product item -->
											<li class="firstt">
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">This is Title</a></h4>
														<span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
													</figcaption>
												</figure>                         
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-sale" href="#">SALE!</span>
											</li>
											<!-- start single product item -->
											<li>
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
														<span class="aa-product-price">$45.50</span>
													</figcaption>
												</figure>                         
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
											</li>
											<!-- start single product item -->
											<li>
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
														<span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
													</figcaption>
												</figure>                          
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
											</li>
										</ul>
									</div>
									<!-- / sports product category -->
									<!-- start electronic product category -->
									<div class="tab-pane fade" id="electronics">
										<ul class="aa-product-catg">
											<!-- start single product item -->
											<li class="firstt">
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">This is Title</a></h4>
														<span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
													</figcaption>
												</figure>                         
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-sale" href="#">SALE!</span>
											</li>
											<!-- start single product item -->
											<li>
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
														<span class="aa-product-price">$45.50</span>
													</figcaption>
												</figure>                         
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
											</li>
											<!-- start single product item -->
											<li>
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
														<span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
													</figcaption>
												</figure>                          
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
											</li>
											<!-- start single product item -->
											<li>
												<figure>
													<a class="aa-product-img" href="#"><img src="https://i.imgsafe.org/8308b96fbf.png" alt="polo shirt img"></a>
													<a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
													<figcaption>
														<h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
														<span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
													</figcaption>
												</figure>                          
												<div class="aa-product-hvr-content">
													<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
												</div>
												<!-- product badge -->
												<span class="aa-badge aa-hot" href="#">HOT!</span>
											</li>                      
										</ul>
										<a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
									</div>
									<!-- / electronic product category -->
								</div>
								<!-- quick view modal -->                  
								<div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">                      
											<div class="modal-body">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<div class="row">
													<!-- Modal view slider -->
													<div class="col-md-6 col-sm-6 col-xs-12">                              
														<div class="aa-product-view-slider">                                
															<div class="simpleLens-gallery-container" id="demo-1">
																<div class="simpleLens-container">
																	<div class="simpleLens-big-image-container">
																		<a class="simpleLens-lens-image" data-lens-image="https://i.imgsafe.org/832f6dac93.png">
																			<img src="https://i.imgsafe.org/832c1eb073.png" class="simpleLens-big-image">
																		</a>
																	</div>
																</div>
																<div class="simpleLens-thumbnails-container">
																	<a href="#" class="simpleLens-thumbnail-wrapper"
																	data-lens-image="https://i.imgsafe.org/832f6dac93.png"
																	data-big-image="https://i.imgsafe.org/832c1eb073.png">
																		<img src="https://i.imgsafe.org/833296db9b.png">
																	</a>                                    
																	<a href="#" class="simpleLens-thumbnail-wrapper"
																	data-lens-image="https://i.imgsafe.org/832f6dac93.png"
																	data-big-image="https://i.imgsafe.org/832c1eb073.png">
																		<img src="https://i.imgsafe.org/833296db9b.png">
																	</a>

																	<a href="#" class="simpleLens-thumbnail-wrapper"
																	data-lens-image="https://i.imgsafe.org/832f6dac93.png"
																	data-big-image="https://i.imgsafe.org/832c1eb073.png">
																		<img src="https://i.imgsafe.org/833296db9b.png">
																	</a>
																</div>
															</div>
														</div>
													</div>
													<!-- Modal view content -->
													<div class="col-md-6 col-sm-6 col-xs-12">
														<div class="aa-product-view-content">
															<h3>T-Shirt</h3>
															<div class="aa-price-block">
																<span class="aa-product-view-price">$34.99</span>
																<p class="aa-product-avilability">Avilability: <span>In stock</span></p>
															</div>
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
															<h4>Size</h4>
															<div class="aa-prod-view-size">
																<a href="#">S</a>
																<a href="#">M</a>
																<a href="#">L</a>
																<a href="#">XL</a>
															</div>
															<div class="aa-prod-quantity">
																<form action="">
																	<select name="" id="">
																		<option value="0" selected="1">1</option>
																		<option value="1">2</option>
																		<option value="2">3</option>
																		<option value="3">4</option>
																		<option value="4">5</option>
																		<option value="5">6</option>
																	</select>
																</form>
																<p class="aa-prod-category">
																	Category: <a href="#">Polo T-Shirt</a>
																</p>
															</div>
															<div class="aa-prod-view-bottom">
																<a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
																<a href="#" class="aa-add-to-cart-btn">View Details</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- / quick view modal -->              
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