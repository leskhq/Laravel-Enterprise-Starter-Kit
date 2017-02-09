<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        @if (Auth::check())
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->full_name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->
            @if(Auth::user()->can('basic-admin-authenticated'))
                <form action="{{ route('search') }}" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="term" class="form-control" placeholder="Search..."/>
                        <span class="input-group-btn">
                        <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                </form>
            @endif
            <!-- /.search form -->
        @endif

        {!! MenuBuilder::renderMenu('home')  !!}

        {!! MenuBuilder::renderMenu('outlet-owner') !!}

        {!! MenuBuilder::renderMenu('admin', true)  !!}
    </section>
    <!-- /.sidebar -->
</aside>
