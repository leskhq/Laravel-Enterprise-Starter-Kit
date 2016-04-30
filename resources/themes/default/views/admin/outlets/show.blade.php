@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $outlet->name }}</h3>
                    <p class="text-muted text-center">{{ $outlet->user->username }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Since</b> <a class="pull-right">{{ $outlet->created_at }}</a>
                        </li>
                    </ul>

                    <a href="{{ route('admin.outlets.confirm-delete', $outlet->id) }}" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><b> Delete </b></a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Outlet</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i>  {{ trans('admin/outlets/general.columns.email') }}</strong>
                    <p class="text-muted">
                        {{ $outlet->email }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> {{ trans('admin/outlets/general.columns.phone') }}</strong>
                    <p class="text-muted">{{ $outlet->phone }}</p>
                    <hr>
                    <strong><i class="fa fa-home margin-r-5"></i> {{ trans('admin/outlets/general.columns.address') }}</strong>
                    <p class="text-muted">{{ $outlet->address }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Customers</a></li>
                    <li><a href="#orders" data-toggle="tab">Sales</a></li>
                    <li><a href="#settings" data-toggle="tab">Edit</a></li>
                </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th>{{ trans('outlet/customers/general.columns.name') }}</th>
                              <th>{{ trans('outlet/customers/general.columns.email') }}</th>
                              <th>{{ trans('outlet/customers/general.columns.phone') }}</th>
                              <th>{{ trans('outlet/customers/general.columns.address') }}</th>
                              <th>{{ trans('outlet/customers/general.columns.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outlet->outletCustomers as $key => $customer)
                            <tr>
                                <td>{!! link_to_route('outlet.customers.show', $customer->name, $customer->id, ['target' => '_blank']) !!}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                <a href="{!! route('outlet.customers.confirm-delete', $customer->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">{{ trans('outlet/customers/general.page.create.section-title') }}</td>
                            </tr>
                            <tr>
                                {!! Form::open( ['route' => 'outlet.customers.store'] ) !!}
                                {!! Form::hidden( 'outlet_laundry_id', $outlet->id ) !!}
                                <td>
                                    {!! Form::text( 'name', null, ['class' => 'form-control', 'placeholder' => trans('outlet/customers/general.columns.name')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'email', null, ['class' => 'form-control', 'placeholder' => trans('outlet/customers/general.columns.email')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'phone', null, ['class' => 'form-control', 'placeholder' => trans('outlet/customers/general.columns.phone')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'address', null, ['class' => 'form-control', 'placeholder' => trans('outlet/customers/general.columns.address')] ) !!}
                                </td>
                                <td>
                                    {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary'] ) !!}
                                </td>
                                {!! Form::close() !!}
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="orders">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('outlet/sales/general.columns.created') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.kilo_quantity') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.piece_quantity') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.kilo_total') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.piece_total') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outlet->outletSales as $sale)
                                <tr>
                                    <td>{!! link_to_route('outlet.sales.show', $sale->created_at, $sale->id, ['target' => '_blank']) !!}</td>
                                    <td>{{ $sale->kilo_quantity }}</td>
                                    <td>{{ $sale->piece_quantity }}</td>
                                    <td>{{ Helpers::reggo($sale->kilo_total) }}</td>
                                    <td>{{ Helpers::reggo($sale->piece_total) }}</td>
                                    <td>
                                        <a href="{!! route('outlet.sales.confirm-delete', $sale->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}">
                                            <i class="fa fa-trash-o deletable"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">{{ trans('outlet/sales/general.page.create.section-title') }}</td>
                            </tr>
                            <tr>
                                {!! Form::open( ['route' => 'outlet.sales.store'] ) !!}
                                {!! Form::hidden( 'outlet_laundry_id', $outlet->id ) !!}
                                <td>
                                    {!! Form::text( 'kilo_quantity', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.kilo_quantity')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'piece_quantity', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.piece_quantity')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'kilo_total', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.kilo_total')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'piece_total', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.piece_total')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'description', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.description')] ) !!}
                                </td>
                                <td>
                                    {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary'] ) !!}
                                </td>
                                {!! Form::close() !!}
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                    <div class="box-body">
                        {!! Form::model($outlet, ['route' => ['admin.outlets.update', $outlet->id], 'method'=>'patch']) !!}

                            @include('partials.forms.outlet_form')

                            <div class="form-group">
                                {!! Form::submit( trans('general.button.edit'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div>
@endsection
