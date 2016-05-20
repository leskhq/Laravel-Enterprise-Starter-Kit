<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Demo Menu</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            {!! $menuContent !!}
        </div><!-- /.nav-collapse -->
    </div>
</nav><!-- /.Fixed navbar -->
