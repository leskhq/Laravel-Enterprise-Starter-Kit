@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials.head_extra_select2_css')

@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( ['url' => url('admin/routes?search=1'), 'id' => 'frmRouteList'] ) !!}

                {!! Form::hidden('export_to_csv', "false", ['id' => 'export_to_csv']) !!}

                <button class="hidden_away" type="submit" title="{{ trans('general.button.filter-results') }}" id="btn-hidden-form-submit"></button>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">

                            <div class="col-sm-6">
                                <h3 class="box-title">{{ trans('admin/routes/general.page.index.table-title') }}</h3>

                                @permission('core.p.routes.create')
                                    <a class="btn btn-default btn-sm" href="{!! route('admin.routes.create') !!}" title="{{ trans('admin/routes/general.button.create') }}">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/routes/general.error.no-permission-to-create-routes') }}">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                @endpermission

                                @permission('core.p.routes.load')
                                    <a class="btn btn-default btn-sm" href="{!! route('admin.routes.load') !!}" title="{{ trans('admin/routes/general.action.load-routes') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/routes/general.action.no-permission-to-load-routes') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                @endpermission

                                @permission('core.p.routes.enable')
                                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmRouteList'].action = '{!! route('admin.routes.enable-selected') !!}';  document.forms['frmRouteList'].submit(); return false;" title="{{ trans('general.button.enable') }}">
                                        <i class="fa fa-check-circle-o"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/routes/general.error.no-permission-to-enable-routes') }}">
                                        <i class="fa fa-check-circle-o"></i>
                                    </a>
                                @endpermission

                                @permission('core.p.routes.disable')
                                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmRouteList'].action = '{!! route('admin.routes.disable-selected') !!}';  document.forms['frmRouteList'].submit(); return false;" title="{{ trans('general.button.disable') }}">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/routes/general.error.no-permission-to-disable-routes') }}">
                                        <i class="fa fa-ban"></i>
                                    </a>
            &nbsp;                   @endpermission

                                @permission('core.p.routes.assign-perm')
                                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmRouteList'].action = '{{ route('admin.routes.save-perms') }}';  document.forms['frmRouteList'].submit(); return false;" title="{{ trans('admin/routes/general.action.save-perms-assignment') }}">
                                        <i class="fa fa-floppy-o"></i>
                                    </a>

                                    {!! Form::select( 'globalPerm', $perms, '', [ 'style' => 'max-width:150px;', 'id' => 'select-global-perm', 'class' => 'select-global-perm', 'placeholder' => trans('admin/routes/general.placeholder.select-permission')] ) !!}
                                @else

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
                                        <button class="btn btn-default" type="submit" title="{{ trans('general.button.filter-results') }}">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                        <a href="{!! route('admin.routes.index') !!}" class="btn btn-default" title="{{ trans('general.button.reset-filter') }}">
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
    @include('partials.body_bottom_select2_js')

    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkRoute[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>

    <script type="text/javascript">

        $(document).ready(function() {
            $(".select-global-perm").select2({
                placeholder: '{{ trans('admin/routes/general.placeholder.select-permission') }}'
            });
            $(".select-perms").select2({
                placeholder: '{{ trans('admin/routes/general.placeholder.select-permission') }}'
            });
        });
    </script>

    <script type="text/javascript">
        $("#btn-export-to-csv").on("click", function () {
            // Set hidden form field.
            $('#export_to_csv').val("true");
            // Post form.
            $("#frmRouteList").submit();
        });
    </script>

@endsection
