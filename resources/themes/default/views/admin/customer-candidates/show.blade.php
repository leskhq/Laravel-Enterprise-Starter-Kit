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
                    <p class="text-muted text-center">{{ Helpers::getCustomerTypeDisplayName($customer->type) }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Followups</b> <a class="pull-right"> {{ count($customer->candidateFollowups) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Since</b> <a class="pull-right">{{ $customer->created_at }}</a>
                        </li>
                    </ul>

                    <a href="{{ route('admin.customer-candidates.change', $customer->id) }}" class="btn btn-info btn-block"><b> Change To Customer </b></a>
                    <a href="{{ route('admin.customer-candidates.confirm-delete', $customer->id) }}" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><b> Delete </b></a>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i>  {{ trans('admin/customer-candidates/general.columns.email') }}</strong>
                    <p class="text-muted">
                        {{ $customer->email }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> {{ trans('admin/customer-candidates/general.columns.address') }}</strong>
                    <p class="text-muted">{{ $customer->address }}</p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> {{ trans('admin/customer-candidates/general.columns.phone') }}</strong>
                    <p class="text-muted">{{ $customer->phone }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Followup</a></li>
                    <li><a href="#settings" data-toggle="tab">Edit</a></li>
                </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th>{{ trans('admin/customer-candidates/followup.columns.created') }}</th>
                              <th>{{ trans('admin/customer-candidates/followup.columns.content') }}</th>
                              <th>{{ trans('admin/customer-candidates/followup.columns.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($followups as $key => $fu)
                            <tr>
                                <td>{{ date('d F, Y', strtotime($fu->created_at)) }}</td>
                                <td>{{ $fu->content }}</td>
                                <td>
                                <a href="{!! route('admin.candidate-followups.confirm-delete', $fu->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        <tr>
                            <td colspan="4">{{ trans('admin/customer-candidates/followup.page.create.section-title') }}</td>
                        </tr>
                        <tr>
                            {!! Form::open( ['route' => 'admin.candidate-followups.store'] ) !!}
                            {!! Form::hidden( 'customer_candidate_id', $customer->id ) !!}
                            <td>
                                {!! Form::text( 'content', null, ['class' => 'form-control', 'placeholder' => trans('admin/customer-candidates/followup.columns.content')] ) !!}
                            </td>
                            <td>
                                {!! Form::text( 'created_at', null, ['class'=>'date form-control', 'placeholder'=> trans('admin/customer-candidates/followup.columns.created')] ) !!}
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
                        {!! Form::model($customer, ['route' => ['admin.customer-candidates.update', $customer->id], 'class' => 'form-horizontal', 'method'=>'patch']) !!}

                            @include('partials.forms.customer_candidate_form')

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
