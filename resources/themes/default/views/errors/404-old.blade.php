<?php
    $page_title = trans('general.error.title-404');
    $page_description = trans('general.error.description-404');
?>

@extends('layouts.master')

@section('content')
    <h1>{{ trans('general.error.page-not-found-404') }}</h1>
    <h3>{{ trans('general.error.client-error', ['error-code' => '404']) }}</h3>
    <hr style="width: 100%; color: black; height: 1px; background-color:black;">
    <h4>{{ trans('general.error.what-is-this') }}</h4>
    <div class="box-body">
        {{ trans('general.error.404-explanation') }}
    </div>
@endsection
