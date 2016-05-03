<div class="wrapper">

    <!-- Header -->
    @include('partials._bootstrap-menu-si')

   

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
      

        <!-- Main content -->
        <section class="content">

            <div class="box-body">
                @include('flash::message')
                @include('partials._errors')
            </div>

            <!-- Your Page Content Here -->
            @yield('content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Body Footer -->
    @include('partials._body_footer')

    @if ( config('app.right_sidebar') )
        <!-- Body right sidebar -->
        @include('partials._body_right_sidebar')
    @endif

</div><!-- ./wrapper -->

