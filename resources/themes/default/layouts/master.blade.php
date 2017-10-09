<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ Settings::get('app.short_name') }} | {{ $page_title or "LESK" }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Set a meta reference to the CSRF token for use in AJAX request -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
  <!-- Font Awesome 4.7.0 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/font-awesome/css/font-awesome.min.css") }}">
  <!-- Ionicons v2.0.0 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/Ionicons/css/ionicons.min.css") }}">
  <!-- AdminLTE v2.3.8 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css") }}">

  <!-- Application CSS-->
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

  @include('partials.theme_head')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Optional header section  -->
  @yield('head_extra')

</head>

  <!-- Body -->
  @include('partials.body')

</html>
