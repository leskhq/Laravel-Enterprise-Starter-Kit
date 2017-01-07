@extends('layouts.master')

@section('head_extra')
    <!-- datepicker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" alt="User profile picture">
                <h3 class="profile-username text-center">{{ $partner->name }}</h3>
                <p class="text-muted text-center">{{ $partner->type }}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Tanggal Aktif</b> <a class="pull-right"> {{ $partner->active_date }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Since</b> <a class="pull-right">{{ $partner->created_at }}</a>
                    </li>
                </ul>
        
                <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><b> Delete </b></a>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Mitra</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                <p class="text-muted">
                    {{ $partner->email }}
                </p>
                <hr>
                <strong><i class="fa fa-phone margin-r-5"></i> Telpon</strong>
                <p class="text-muted">{{ $partner->phone }}</p>
                <hr>
                <strong><i class="fa fa-home margin-r-5"></i> Alamat</strong>
                <p class="text-muted">{{ $partner->address }}</p>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#settings" data-toggle="tab">Pembayaran</a></li>
                <li><a href="#activity" data-toggle="tab">Edit</a></li>
            </ul>
          <div class="tab-content">
            <div class="tab-pane" id="activity">
                <div class="box-body">
                    {!! Form::model($partner, ['route' => ['admin.partners.update', $partner->id], 'method'=>'patch']) !!}

                        @include('partials.forms.partner_form')

                        <div class="form-group">
                            {!! Form::submit( trans('general.button.edit'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div><!-- /.tab-pane -->

            <div class="active tab-pane" id="settings">
                <div class="box-body">
                    @if($partner->partnerFee)
                        {!! Form::model($partner->partnerFee, [ 'route' => ['admin.partners.update-fee', $partner->id], 'method' => 'PATCH' ]) !!}
                            @include('partials.forms.fee_create')
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open([ 'route' => 'admin.partners.store-fee', 'method' => 'POST' ]) !!}
                            {!! Form::hidden('partner_id', $partner->id) !!}
                            @include('partials.forms.fee_create')
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                        {!! Form::close() !!}
                    @endif
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
