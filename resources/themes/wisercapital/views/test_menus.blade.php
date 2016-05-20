@extends('layouts.master')

@section('content')
    <h1>Hello!</h1>
    <div class="box-body">
        Just a little page to demo the menu and breadcrumb trail options!
    </div>

    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">
                Dynamically generated breadcrumb trail with default Bootstrap handler:
                {!! MenuBuilder::renderBreadcrumbTrail()  !!}
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">
                Dynamically generated ROOT menu with Light Bootstrap handler:
                {!! MenuBuilder::renderMenu('root', false, 'App\Handlers\BootstrapLightMenuHandler')  !!}
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">
                Dynamically generated Home menu with Dark Bootstrap handler:
                {!! MenuBuilder::renderMenu('home', false, 'App\Handlers\BootstrapDarkMenuHandler')  !!}
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">
                Dynamically generated Admin menu with Bootstrap handler:
                {!! MenuBuilder::renderMenu('admin', false, 'App\Handlers\BootstrapLightMenuHandler')  !!}
            </div>
        </div>
    </div>

@endsection
