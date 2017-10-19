@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( ['url' => url('admin/settings'), 'id' => 'frmSettingList'] ) !!}

                <button class="hidden_away" type="submit" title="{{ trans('general.button.filter-results') }}" id="btn-hidden-form-submit"></button>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">

                            <div class="col-sm-6">
                                <h3 class="box-title">{{ trans('admin/settings/general.page.index.table-title') }}</h3>

                                @permission('core.p.settings.create')
                                    <a class="btn btn-default btn-sm" href="{!! route('admin.settings.create') !!}" title="{{ trans('admin/settings/general.button.create') }}">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/settings/general.error.no-permission-to-create-settings') }}">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                @endpermission

                                @permission('core.p.settings.load')
                                    <a class="btn btn-default btn-sm" href="{!! route('admin.settings.load') !!}" title="{{ trans('admin/settings/general.action.load-settings') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/settings/general.action.no-permission-to-load-settings') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                @endpermission

                                @permission('core.p.settings.delete')
                                    <a class="btn btn-default btn-sm" href="{!! route('admin.settings.confirm-delete-selected') !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('admin/settings/general.action.delete-selected') }}">
                                        <i class="fa fa-trash-o deletable"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/settings/general.action.no-permission-to-delete-selected') }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                @endpermission

                            </div> <!-- col-sm-6 -->

                        </div> <!-- row -->
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

    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkSetting[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>

@endsection
