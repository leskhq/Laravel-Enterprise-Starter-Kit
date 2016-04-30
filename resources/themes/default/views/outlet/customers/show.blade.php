@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $customer->name }}</h3>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Since</b> <a class="pull-right">{{ $customer->created_at }}</a>
                        </li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Customer</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i>  {{ trans('outlet/customers/general.columns.email') }}</strong>
                    <p class="text-muted">
                        {{ $customer->email }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> {{ trans('outlet/customers/general.columns.phone') }}</strong>
                    <p class="text-muted">{{ $customer->phone }}</p>
                    <hr>
                    <strong><i class="fa fa-home margin-r-5"></i> {{ trans('outlet/customers/general.columns.address') }}</strong>
                    <p class="text-muted">{{ $customer->address }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
@endsection
