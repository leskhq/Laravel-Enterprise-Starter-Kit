@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( ['url' => url('admin/roles?search=1'), 'id' => 'frmRoleList'] ) !!}

                {!! Form::hidden('export_to_csv', "false", ['id' => 'export_to_csv']) !!}

                <button class="hidden_away" type="submit" title="{{ trans('general.button.filter-results') }}" id="btn-hidden-form-submit"></button>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">

                            <div class="col-sm-6">
                                <h3 class="box-title">{{ trans('admin/roles/general.page.index.table-title') }}</h3>

                                @permission('core.p.roles.create')
                                    <a class="btn btn-default btn-sm" href="{!! route('admin.roles.create') !!}" title="{{ trans('admin/roles/general.button.create') }}">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/roles/general.error.no-permission-to-create-roles') }}">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                @endpermission

                                @permission('core.p.roles.enable')
                                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmRoleList'].action = '{!! route('admin.roles.enable-selected') !!}';  document.forms['frmRoleList'].submit(); return false;" title="{{ trans('general.button.enable') }}">
                                        <i class="fa fa-check-circle-o"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/roles/general.error.no-permission-to-enable-roles') }}">
                                        <i class="fa fa-check-circle-o"></i>
                                    </a>
            &nbsp;                   @endpermission

                                @permission('core.p.roles.disable')
                                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmRoleList'].action = '{!! route('admin.roles.disable-selected') !!}';  document.forms['frmRoleList'].submit(); return false;" title="{{ trans('general.button.disable') }}">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/roles/general.error.no-permission-to-disable-roles') }}">
                                        <i class="fa fa-ban"></i>
                                    </a>
            &nbsp;                   @endpermission
                            </div> <!-- col-sm-6 -->

                            <div class="col-sm-6">
                                {!! $filter->open !!}
                                    <div class="input-group custom-search-form">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit" title="{{ trans('general.button.export-results') }}" id="btn-export-to-csv">
                                                <span class="glyphicon glyphicon-export"></span>
                                            </button>
                                        </span>
                                        {!! $filter->field('srch') !!}
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                            <a href="{!! route('admin.roles.index') !!}" class="btn btn-default">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </span>
                                    </div>
                                {!! $filter->close !!}
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
    @include('partials.body_bottom_tab_with_state_reset_js')

    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkRole[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>

    <script type="text/javascript">
        $("#btn-export-to-csv").on("click", function () {
            // Set hidden form field.
            $('#export_to_csv').val("true");
            // Post form.
            $("#frmRoleList").submit();
        });
    </script>

@endsection
