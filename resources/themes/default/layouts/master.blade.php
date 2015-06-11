<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="{{ Theme::asset('css/styles.css', null, true) }}"/>

</head>
<body>

	<div>@include('partials.header')</div>

	<div>@yield('content')</div>

	<div>@include('partials.footer')</div>

</body>
</html>
