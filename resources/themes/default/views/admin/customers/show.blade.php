@extends('layouts.master')

@section('head_extra')
    <!-- datepicker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.min.css">
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $customer->name }}</h3>
                    <p class="text-muted text-center">{{ $customer->getCustomerTypeDisplayName() }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Followups</b> <a class="pull-right"> {{ count($customer->customerFollowups) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Since</b> <a class="pull-right">{{ $customer->created_at }}</a>
                        </li>
                    </ul>
			
		    <a href="{{ route('admin.customers.export-sales', $customer->id) }}" class="btn btn-info btn-block" title="{{ trans('general.button.export') }}"><b> Export Sales </b></a>
                    <a href="{{ route('admin.customers.confirm-delete', $customer->id) }}" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><b> Delete </b></a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Customer</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i>  {{ trans('admin/customers/general.columns.email') }}</strong>
                    <p class="text-muted">
                        {{ $customer->email }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> {{ trans('admin/customers/general.columns.phone') }}</strong>
                    <p class="text-muted">{{ $customer->phone }}</p>
                    <hr>
                    <strong><i class="fa fa-home margin-r-5"></i> {{ trans('admin/customers/general.columns.address') }}</strong>
                    <p class="text-muted">{{ $customer->address }}</p>
                    <hr>
                    <strong><i class="fa fa-home margin-r-5"></i> {{ trans('admin/customers/general.columns.send_address') }}</strong>
                    <p class="text-muted">{{ $customer->send_address }}</p>
                    <hr>
                    <strong><i class="fa fa-tags margin-r-5"></i> {{ trans('admin/customers/general.columns.laundry_name') }}</strong>
                    <p class="text-muted">{{ $customer->laundry_name }}</p>
                    <hr><strong><i class="fa fa-map-marker margin-r-5"></i> {{ $customer->type == 3 || $customer->type == 2 ?trans('admin/customers/general.columns.outlet_address') : trans('admin/customers/general.columns.laundry_address') }}</strong>
                    <p class="text-muted">{{ $customer->laundry_address }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Followup</a></li>
                    <li><a href="#orders" data-toggle="tab">Order History</a></li>
                    <li><a href="#settings" data-toggle="tab">Edit</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>{{ trans('admin/customers/followup.columns.created') }}</th>
                                  <th>{{ trans('admin/customers/followup.columns.content') }}</th>
                                  <th>{{ trans('admin/customers/followup.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->customerFollowups as $key => $fu)
                                <tr>
                                    <td>{{ date('d F, Y', strtotime($fu->created_at)) }}</td>
                                    <td>{{ $fu->content }}</td>
                                    <td>
                                    <a href="{!! route('admin.customer-followups.confirm-delete', $fu->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            <tr>
                                <td colspan="4">{{ trans('admin/customers/followup.page.create.section-title') }}</td>
                            </tr>
                            <tr>
                                {!! Form::open( ['route' => 'admin.customer-followups.store'] ) !!}
                                {!! Form::hidden( 'customer_id', $customer->id ) !!}
                                <td>
                                    {!! Form::text( 'content', null, ['class' => 'form-control', 'placeholder' => trans('admin/customers/followup.columns.content')] ) !!}
                                </td>
                                <td>
                                    {!! Form::text( 'created_at', null, ['class'=>'date form-control', 'placeholder'=> trans('admin/customers/followup.columns.created')] ) !!}
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
                                    <th>{{ trans('admin/sales/general.columns.id') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.order_date') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.nominal') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{!! link_to_route('admin.sales.show', $sale->id, $sale->id) !!}</td>
                                        <td>{{ Helpers::date($sale->order_date) }}</td>
                                        <td>{{ Helpers::reggo($sale->nominal) }}</td>
                                        <td>
                                            <a href="{!! route('admin.sales.confirm-delete', $sale->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}">
                                                <i class="fa fa-trash-o deletable"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <div class="box-body">
                            {!! Form::model($customer, ['route' => ['admin.customers.update', $customer->id], 'method'=>'patch']) !!}

                                @include('partials.forms.customer_form')

                                <div class="form-group">
                                    {!! Form::submit( trans('general.button.edit'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                                </div>

                            {!! Form::close() !!}
                        </div>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

@endsection

@section('body_bottom')
    <!-- datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

    @include('partials.body_bottom_js.create_customer_candidate')

    <script type="text/javascript">
        $('.date').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: false,
            autoclose: true
        });
    </script>
@endsection
