@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.permissions.enable-selected', 'id' => 'frmPermList') ) !!}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin/permissions/general.page.index.table-title') }}</h3>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="{!! route('admin.permissions.create') !!}" title="{{ trans('admin/permissions/general.action.create') }}">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="{!! route('admin.permissions.generate') !!}" title="{{ trans('admin/permissions/general.action.generate') }}">
                            <i class="fa fa-refresh"></i>
                        </a>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmPermList'].action = '{!! route('admin.permissions.enable-selected') !!}';  document.forms['frmPermList'].submit(); return false;" title="{{ trans('general.button.enable') }}">
                            <i class="fa fa-check-circle-o"></i>
                        </a>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmPermList'].action = '{!! route('admin.permissions.disable-selected') !!}';  document.forms['frmPermList'].submit(); return false;" title="{{ trans('general.button.disable') }}">
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
                                        <th>{{ trans('admin/permissions/general.columns.display_name') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.description') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.routes') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.roles') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.actions') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center">
                                            <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                                <i class="fa fa-check-square-o"></i>
                                            </a>
                                        </th>
                                        <th>{{ trans('admin/permissions/general.columns.display_name') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.description') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.routes') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.roles') }}</th>
                                        <th>{{ trans('admin/permissions/general.columns.actions') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($perms as $perm)
                                        <tr>
                                            <td align="center">{!! Form::checkbox('chkPerm[]', $perm->id); !!}</td>
                                            <td>{!! link_to_route('admin.permissions.show', $perm->display_name, [$perm->id], []) !!}</td>
                                            <td>{!! link_to_route('admin.permissions.show', $perm->description, [$perm->id], []) !!}</td>
                                            <td>{{ $perm->routes->count() }}</td>
                                            <td>{{ $perm->roles->count() }}</td>
                                            <td>
                                                @if ( $perm->isEditable() )
                                                    <a href="{!! route('admin.permissions.edit', $perm->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                                @else
                                                    <i class="fa fa-pencil-square-o text-muted" title="{{ trans('admin/permissions/general.error.cant-edit-this-permission') }}"></i>
                                                @endif

                                                @if ( $perm->enabled )
                                                    <a href="{!! route('admin.permissions.disable', $perm->id) !!}" title="{{ trans('general.button.disable') }}"><i class="fa fa-check-circle-o enabled"></i></a>
                                                @else
                                                    <a href="{!! route('admin.permissions.enable', $perm->id) !!}" title="{{ trans('general.button.enable') }}"><i class="fa fa-ban disabled"></i></a>
                                                @endif

                                                @if ( $perm->isDeletable() )
                                                    <a href="{!! route('admin.permissions.confirm-delete', $perm->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                                @else
                                                    <i class="fa fa-trash-o text-muted" title="{{ trans('admin/permissions/general.error.cant-delete-perm-in-use') }}"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $perms->render() !!}
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
            checkboxes = document.getElementsByName('chkPerm[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>
@endsection
