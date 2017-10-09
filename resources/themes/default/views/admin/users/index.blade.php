@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.users.enable-selected', 'id' => 'frmUserList') ) !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/users/general.page.index.table-title') }}</h3>

                    @permission('core.users.create')
                        <a class="btn btn-default btn-sm" href="{!! route('admin.users.create') !!}" title="{{ trans('admin/users/general.button.create') }}">
                            <i class="fa fa-plus-square"></i>
                        </a>
                    @else
                        <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/users/general.error.no-permission-to-create-users') }}">
                            <i class="fa fa-plus-square"></i>
                        </a>
                    @endpermission

                    @permission('core.users.enable')
                        <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmUserList'].action = '{!! route('admin.users.enable-selected') !!}';  document.forms['frmUserList'].submit(); return false;" title="{{ trans('general.button.enable') }}">
                            <i class="fa fa-check-circle-o"></i>
                        </a>
                    @else
                        <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/users/general.error.no-permission-to-enable-users') }}">
                            <i class="fa fa-check-circle-o"></i>
                        </a>
&nbsp;                   @endpermission

                    @permission('core.users.disable')
                        <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmUserList'].action = '{!! route('admin.users.disable-selected') !!}';  document.forms['frmUserList'].submit(); return false;" title="{{ trans('general.button.disable') }}">
                            <i class="fa fa-ban"></i>
                        </a>
                    @else
                        <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/users/general.error.no-permission-to-disable-users') }}">
                            <i class="fa fa-ban"></i>
                        </a>
&nbsp;                   @endpermission

                </div>
                <div class="box-body">
                    {!! $grid !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection

@section('body_bottom')
    @include('partials.body_bottom_tab_with_state_reset_js')

@endsection
