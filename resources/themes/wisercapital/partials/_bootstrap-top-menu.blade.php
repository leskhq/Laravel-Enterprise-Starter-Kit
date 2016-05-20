<nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ route('home') }}" class="navbar-brand"><img src="/assets/themes/wisercapital/img/Wiser-Capital-logo.gif" height="22" width="145" alt="Wiser Capital Logo" /></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
             
	        @if (Auth::check())
	          
	          
          
          <!-- Start Menu -->
           {!! $menuContent !!}
          
          <!-- End Menu -->
         
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            
                  
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->username }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" class="img-circle" alt="User Image">

                  <p>
                     {{ Auth::user()->full_name }}
                     <small>Member since {{ Auth::user()->created_at->format("F, Y") }}</small>
                  </p>
                </li>
                
                  @if ( config('app.extended_user_menu') )
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                            @endif
               
            
                <!-- Menu Footer-->
                <li class="user-footer">
                   @if ( config('app.user_profile_link') )
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                   @endif
                  
                  
                 
                                
                  <div class="pull-right">
                     {!! link_to_route('logout', 'Sign out', [], ['class' => "btn btn-default btn-flat"]) !!}
                    
                  </div>
                </li>
                
                    @if ( config('app.right_sidebar') )
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    @endif
                @else
                <ul class='nav navbar-nav'>
                    <li>{!! link_to_route('login', 'Sign in') !!}</li>
                    @if (config('app.allow_registration'))
                        <li>{!! link_to_route('register', 'Register') !!}</li>
                    @endif
                </ul>
                @endif
                
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    
    