@extends('layouts.master')

@section('content')

	<div class="row">
		<div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $user->first_name .' '. $user->last_name }}</h3>
                    <p class="text-muted text-center">Affiliator</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Clicks</b> <a class="pull-right"> {{ $user->affiliate->click }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Customer Terdaftar</b> <a class="pull-right">{{ count($user->affiliate->storeCustomers) }}</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><b> Delete </b></a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Affiliator</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-link margin-r-5"></i>  Link</strong>
                    <p class="text-muted">
                        <a href="{{ url('/'.$user->affiliate->link) }}">laundrycleanique.com/aff/{{ $user->affiliate->link }}</a>
                    </p>
                    <hr>
                    <strong><i class="fa fa-money margin-r-5"></i> Balance</strong>
                    <p class="text-muted">{{ Helpers::reggo($user->affiliate->balance) }}</p>
                    <hr>
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p class="text-muted">{{ $user->email }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
        	<div class="nav-tabs-custom">
        		<ul class="nav nav-tabs">
        			<li class="active"><a href="#firsttab" data-toggle="tab">Daftar Customer</a></li>
        		</ul>
        		<div class="tab-content">
        			<div class="active tab-pane" id="activity">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>{{ trans('admin/customers/followup.columns.created') }}</th>
                                  <th>Nama</th>
                                  <th>{{ trans('admin/customers/followup.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->affiliate->storeCustomers as $key => $value)
                                <tr>
                                    <td>{{ date('d F, Y', strtotime($value->user->storeCustomer->created_at)) }}</td>
                                    <td>{{ $value->user->first_name .' '. $value->user->last_name }}</td>
                                    <td>
                                    	<a href="#" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.tab-pane -->
        		</div>
        	</div>
        </div>
	</div>

@endsection