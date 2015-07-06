@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
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

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin/permissions/general.columns.name') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.routes') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.roles') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.created') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('admin/permissions/general.columns.name') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.routes') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.roles') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.created') }}</th>
                                    <th>{{ trans('admin/permissions/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($perms as $perm)
                                    <tr>
                                        <td>{!! link_to_route('admin.permissions.show', $perm->name, [$perm->id], []) !!}</td>
                                        <td>{{ $perm->routes->count() }}</td>
                                        <td>{{ $perm->roles->count() }}</td>
                                        <td>{{ $perm->created_at->diffForHumans() }}</td>
                                        <td>
                                            @if ( $perm->isEditable() )
                                                <a href="{!! route('admin.permissions.edit', $perm->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                            @else
                                                <i class="fa fa-pencil-square-o text-muted" title="{{ trans('admin/permissions/general.error.cant-edit-this-permission') }}"></i>
                                            @endif
                                            @if ( $perm->isDeletable() )
                                                <a href="{!! route('admin.permissions.confirm-delete', $perm->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o"></i></a>
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
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection
