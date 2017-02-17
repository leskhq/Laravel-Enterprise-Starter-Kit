<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    	<link rel="stylesheet" href="{{ asset('/bower_components/printcss/print.css') }}">
    </head>
    <script type="text/javascript">
      window.print();
    </script>
    <body>
    	@yield('content')
    </body>
</html>
