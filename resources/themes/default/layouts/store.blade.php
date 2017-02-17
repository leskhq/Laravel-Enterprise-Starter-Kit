<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>Daily Shop | Home</title>
        
        <!-- Font awesome -->
        {{-- <link href="css/font-awesome.css" rel="stylesheet"> --}}
        <!-- Bootstrap -->
        {{-- <link href="css/bootstrap.css" rel="stylesheet">    --}}
        <!-- SmartMenus jQuery Bootstrap Addon CSS -->
        {{-- <link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet"> --}}
        <!-- Product view slider -->
        {{-- <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">     --}}
        <!-- slick slider -->
        {{-- <link rel="stylesheet" type="text/css" href="css/slick.css"> --}}
        <!-- price picker slider -->
        {{-- <link rel="stylesheet" type="text/css" href="css/nouislider.css"> --}}
        <!-- Theme color -->
        {{-- <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet"> --}}

        <!-- Main style sheet -->
        {{-- <link href="css/style.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="/css/store.css">
        {{-- <link rel="stylesheet" href="{{ elixir('css/style.css') }}"> --}}

        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            @yield('top_styles')
        </style>
      
    </head>
    <body> 
        <!-- wpf loader Two -->
        <div id="wpf-loader-two">          
            <div class="wpf-loader-two-inner">
                <span>Loading</span>
            </div>
        </div> 
        <!-- / wpf loader Two -->       
        <!-- SCROLL TOP BUTTON -->
        <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
        <!-- END SCROLL TOP BUTTON -->

        <!-- Start header section -->
        <header id="aa-header">
            <!-- start header top  -->
            <div class="aa-header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aa-header-top-area">
                                <!-- start header top left -->
                                <div class="aa-header-top-left">
                                    <!-- start cellphone -->
                                    <div class="cellphone hidden-xs">
                                        <p><span class="fa fa-phone"></span>00-62-658-658</p>
                                    </div>
                                    <!-- / cellphone -->
                                </div>
                                <!-- / header top left -->
                                <div class="aa-header-top-right">
                                    <ul class="aa-head-top-nav-right">
                                        <li class="hidden-xs"><a href="cart.html">My Cart</a></li>
                                        @if(Auth::check())
                                            <li><a href="/member/{{ Auth::user()->id }}">Profile saya</a></li>
                                            <li><a href="{{ route('logout') }}">Logout</a></li>
                                        @else
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / header top  -->

            <!-- start header bottom  -->
            <div class="aa-header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aa-header-bottom-area">
                                <!-- logo  -->
                                <div class="aa-logo">
                                    <!-- Text based logo -->
                                    <a href="/store">
                                        <span class="fa fa-shopping-cart"></span>
                                        <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                                    </a>
                                    <!-- img based logo -->
                                    <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
                                </div>
                                <!-- / logo  -->
                                <!-- cart box -->
                                <div class="aa-cartbox">
                                    <a class="aa-cart-link" href="cart">
                                        <span class="fa fa-shopping-basket"></span>
                                        <span class="aa-cart-title">SHOPPING CART</span>
                                        <span class="aa-cart-notify">
                                            @if(Cart::isEmpty()) 0 @endif
                                            {{ Cart::getContent()->count() }}
                                        </span>
                                    </a>
                                    <div class="aa-cartbox-summary">
                                        @if(!Cart::isEmpty())
                                        <ul>
                                            @foreach(Cart::getContent() as $value)
                                            <li>
                                                <a class="aa-cartbox-img" href="#"><img src="https://i.imgsafe.org/8317aeed6d.jpg" alt="img"></a>
                                                <div class="aa-cartbox-info">
                                                    <h4><a href="#">{{ $value->name }}</a></h4>
                                                    <p>{{ $value->quantity }} x {{ Helpers::reggo($value->price) }}</p>
                                                </div>
                                                <a class="aa-remove-product" href="{{ route('store.remove-cart-item', $value->id) }}"><span class="fa fa-times"></span></a>
                                            </li>
                                            @endforeach
                                            <li>
                                                <span class="aa-cartbox-total-title">
                                                    Total
                                                </span>
                                                <span class="aa-cartbox-total-price">
                                                    {{ Helpers::reggo(Cart::getTotal()) }}
                                                </span>
                                            </li>
                                        </ul>
                                        <a class="aa-cartbox-checkout aa-primary-btn" href="/cart">Keranjang</a>
                                        @else
                                            belum ada item
                                        @endif
                                    </div>
                                </div>
                                <!-- / cart box -->
                                <!-- search box -->
                                <div class="aa-search-box">
                                    <form action="">
                                        <input type="text" name="" id="" placeholder="Search here ex. 'man' ">
                                        <button type="submit"><span class="fa fa-search"></span></button>
                                    </form>
                                </div>
                              <!-- / search box -->             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / header bottom  -->
        </header>
        <!-- / header section -->
        <!-- menu -->
        <section id="menu">
            <div class="container">
                <div class="menu-area">
                    <!-- Navbar -->
                    <div class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>          
                        </div>
                        <div class="navbar-collapse collapse">
                            <!-- Left nav -->
                            <ul class="nav navbar-nav">
                                <li><a href="store">Home</a></li>
                                <li><a href="contact">Contact</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>       
            </div>
        </section>
        <!-- / menu -->

        @include('flash::message')
  
        @yield('content')

        <!-- Subscribe section -->
        <section id="aa-subscribe">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-subscribe-area">
                            <h3>Subscribe our newsletter </h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
                            <div class="col-md-6 col-md-offset-3">
                                <form action="" class="aa-subscribe-form">
                                    <input type="email" name="" id="" placeholder="Enter your Email">
                                    <input type="submit" value="Subscribe">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / Subscribe section -->

        <!-- footer -->  
        <footer id="aa-footer">
            <!-- footer bottom -->
            <div class="aa-footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aa-footer-top-area">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="aa-footer-widget">
                                            <h3>Main Menu</h3>
                                            <ul class="aa-footer-nav">
                                                <li><a href="#">Home</a></li>
                                                <li><a href="#">Our Services</a></li>
                                                <li><a href="#">Our Products</a></li>
                                                <li><a href="#">About Us</a></li>
                                                <li><a href="#">Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="aa-footer-widget">
                                            <div class="aa-footer-widget">
                                                <h3>Knowledge Base</h3>
                                                <ul class="aa-footer-nav">
                                                    <li><a href="#">Delivery</a></li>
                                                    <li><a href="#">Returns</a></li>
                                                    <li><a href="#">Services</a></li>
                                                    <li><a href="#">Discount</a></li>
                                                    <li><a href="#">Special Offer</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="aa-footer-widget">
                                            <div class="aa-footer-widget">
                                                <h3>Useful Links</h3>
                                                <ul class="aa-footer-nav">
                                                    <li><a href="#">Site Map</a></li>
                                                    <li><a href="#">Search</a></li>
                                                    <li><a href="#">Advanced Search</a></li>
                                                    <li><a href="#">Suppliers</a></li>
                                                    <li><a href="#">FAQ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="aa-footer-widget">
                                            <div class="aa-footer-widget">
                                                <h3>Contact Us</h3>
                                                <address>
                                                    <p> 25 Astor Pl, NY 10003, USA</p>
                                                    <p><span class="fa fa-phone"></span>+1 212-982-4589</p>
                                                    <p><span class="fa fa-envelope"></span>dailyshop@gmail.com</p>
                                                </address>
                                                <div class="aa-footer-social">
                                                    <a href="#"><span class="fa fa-facebook"></span></a>
                                                    <a href="#"><span class="fa fa-twitter"></span></a>
                                                    <a href="#"><span class="fa fa-google-plus"></span></a>
                                                    <a href="#"><span class="fa fa-youtube"></span></a>
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
            <!-- footer-bottom -->
            <div class="aa-footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aa-footer-bottom-area">
                                <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
                                <div class="aa-footer-payment">
                                    <span class="fa fa-cc-mastercard"></span>
                                    <span class="fa fa-cc-visa"></span>
                                    <span class="fa fa-paypal"></span>
                                    <span class="fa fa-cc-discover"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- / footer -->

        <!-- Login Modal -->  
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">                      
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Login or Register</h4>
                        <form class="aa-login-form" action="auth/login" method="post">
                        {!! Form::token() !!}
                            <label for="">Username<span>*</span></label>
                            <input name="username" type="text" placeholder="Username">
                            <label for="">Password<span>*</span></label>
                            <input name="password" type="password" placeholder="Password">
                            <button class="aa-browse-btn" type="submit">Login</button>
                            <label for="rememberme" class="rememberme">
                            <input name="remember" type="checkbox" id="rememberme"> Remember me </label>
                            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                            <div class="aa-register-now">
                                Don't have an account?<a href="daftar">Register now!</a>
                            </div>
                        </form>
                    </div>                        
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>    

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{-- <script src="{{ elixir('js/store.js') }}"></script> --}}

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/d-shop/bootstrap.js"></script>  
    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="/js/d-shop/jquery.smartmenus.js"></script>
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="/js/d-shop/jquery.smartmenus.bootstrap.js"></script>  
    <!-- Product view slider -->
    <script type="text/javascript" src="/js/d-shop/jquery.simpleGallery.js"></script>
    <script type="text/javascript" src="/js/d-shop/jquery.simpleLens.js"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="/js/d-shop/slick.js"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="/js/d-shop/nouislider.js"></script>

    <!-- Custom js -->
    <script src="/js/d-shop/custom.js"></script>
    
    <script src="/js/modal.js"></script>

    @yield('bottom_scripts')

    </body>
</html>