@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.modules.enable-selected', 'id' => 'frmModuleList') ) !!}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin/modules/general.page.index.table-title') }}</h3>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="{!! route('admin.modules.optimize') !!}" title="{{ trans('admin/modules/general.button.optimize') }}">
                            <i class="fa fa-fighter-jet"></i>
                        </a>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmModuleList'].action = '{!! route('admin.modules.enable-selected') !!}';  document.forms['frmModuleList'].submit(); return false;" title="{{ trans('general.button.enable') }}">
                            <i class="fa fa-check-circle-o"></i>
                        </a>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmModuleList'].action = '{!! route('admin.modules.disable-selected') !!}';  document.forms['frmModuleList'].submit(); return false;" title="{{ trans('general.button.disable') }}">
                            <i class="fa fa-ban"></i>
                        </a>

                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">
                                            <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                                <i class="fa fa-check-square-o"></i>
                                            </a>
                                        </th>
                                        <th>{{ trans('admin/modules/general.columns.name') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.description') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.order') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.actions') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center">
                                            <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                                <i class="fa fa-check-square-o"></i>
                                            </a>
                                        </th>
                                        <th>{{ trans('admin/modules/general.columns.name') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.description') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.order') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.actions') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($modules as $mod)
                                        <tr>
                                            <td align="center">{!! Form::checkbox('chkMod[]', $mod['slug']); !!}</td>
                                            <td>{{ $mod['name'] }}</td>
                                            <td>{{ $mod['description'] }}</td>
                                            <td>{{ $mod['order'] }}</td>
                                            <td>
                                                @if ( Module::isInitialized($mod['slug']) )
                                                    <a href="{!! route('admin.modules.uninitialize', $mod['slug']) !!}" title="{{ trans('admin/modules/general.button.uninitialize') }}"><i class="fa fa-thumbs-up enabled"></i></a>
                                                @else
                                                    <a href="{!! route('admin.modules.initialize', $mod['slug']) !!}" title="{{ trans('admin/modules/general.button.initialize') }}"><i class="fa fa-thumbs-down disabled"></i></a>
                                                @endif
                                                @if ( Module::isEnabled($mod['slug']) )
                                                    <a href="{!! route('admin.modules.disable', $mod['slug']) !!}" title="{{ trans('general.button.disable') }}"><i class="fa fa-check-circle-o enabled"></i></a>
                                                @else
                                                    <a href="{!! route('admin.modules.enable', $mod['slug']) !!}" title="{{ trans('general.button.enable') }}"><i class="fa fa-ban disabled"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkMod[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>
@endsection
