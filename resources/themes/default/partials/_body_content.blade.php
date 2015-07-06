<div class="wrapper">

    <!-- Header -->
    @include('partials._body_header')

    <!-- Sidebar -->
    @include('partials._body_left_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or "Page Title" }}
                <small>{{ $page_description or "Page description" }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

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

    <!-- Body right sidebar -->
    @include('partials._body_right_sidebar')

</div><!-- ./wrapper -->

