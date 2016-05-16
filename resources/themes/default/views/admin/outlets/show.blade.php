@extends('layouts.master')

@section('head_extra')
    <!-- datepicker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $outlet->name }}</h3>
                    <p class="text-muted text-center">...</p>

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
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    @if(Auth::user()->username != 'indry')
                                    <a href="{!! route('outlet.customers.confirm-delete', $customer->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @if(Auth::user()->username != 'indry')
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
                            @endif
                        </tbody>
                    </table>
                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="orders">
                    <table class="table table-striped" id="example2">
                        <thead>
                            <tr>
                                <th>{{ trans('outlet/sales/general.columns.created') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.kilo_quantity') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.piece_quantity') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.total_kilo_cost') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.total_piece_cost') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.income') }}</th>
                                <th>{{ trans('outlet/sales/general.columns.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outlet->outletSales as $sale)
                                <tr>
                                    <td>{{ $sale->created_at }}</td>
                                    <td>{{ $sale->kilo_quantity }}</td>
                                    <td>{{ $sale->piece_quantity }}</td>
                                    <td>{{ Helpers::reggo($sale->total_kilo_cost) }}</td>
                                    <td>{{ Helpers::reggo($sale->total_piece_cost) }}</td>
                                    <td>{{ Helpers::reggo($sale->income) }}</td>
                                    <td>
                                    @if(Auth::user()->username != 'indry')
                                        <a href="{!! route('outlet.sales.confirm-delete', $sale->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}">
                                            <i class="fa fa-trash-o deletable"></i>
                                        </a>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(Auth::user()->username != 'indry')
                    <table class="table">
                        <tr>
                            <td colspan="7">{{ trans('outlet/sales/general.page.create.section-title') }}</td>
                        </tr>
                        <tr>
                            {!! Form::open( ['route' => 'outlet.sales.store'] ) !!}
                            {!! Form::hidden( 'outlet_laundry_id', $outlet->id ) !!}
                            <td>
                                {!! Form::text( 'kilo_quantity', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.kilo_quantity')] ) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text( 'piece_quantity', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.piece_quantity')] ) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text( 'total_kilo_cost', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.total_kilo_cost')] ) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text( 'total_piece_cost', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.total_piece_cost')] ) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text( 'income', null, ['class' => 'form-control', 'placeholder' => trans('outlet/sales/general.columns.income')] ) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::text( 'created_at', null, ['class' => 'form-control date', 'placeholder' => trans('outlet/sales/general.columns.created')] ) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary'] ) !!}
                            </td>
                        </tr>
                        {!! Form::close() !!}
                    </table>
                </div><!-- /.tab-pane -->
                @endif

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

@section('body_bottom')
    <!-- datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Datatable -->
    @include('partials.body_bottom_js.datatable_js')

    <script>
        $(document).ready(function() {
            $('.date').datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: false,
                autoclose: true
            });

            $('#example2').DataTable({
                "order": [[ 0, 'desc' ]],
                "ordering": false
            });
        });
    </script>
@endsection
