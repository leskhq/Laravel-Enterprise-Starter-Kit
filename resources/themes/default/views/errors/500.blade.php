<?php
    $page_title = trans('general.error.title-500');
    $page_description = trans('general.error.description-500');
?>

@extends('layouts.master')

@section('content')
    <h1>{{ trans('general.error.internal-error-500') }}</h1>
    <h3>{{ trans('general.error.server-error', ['error-code' => '500']) }}</h3>
    <hr style="width: 100%; color: black; height: 1px; background-color:black;">
    <h4>{{ trans('general.error.what-is-this') }}</h4>
    <div class="box-body">
        {{ trans('general.error.500-explanation') }}
    </div>
@endsection
