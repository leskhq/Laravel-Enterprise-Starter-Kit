@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/roles/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.roles.create') !!}" title="{{ trans('admin/roles/general.button.create') }}">
                        <i class="fa fa-plus-square"></i>
                    </a>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ trans('admin/roles/general.columns.name') }}</th>
                                <th>{{ trans('admin/roles/general.columns.display_name') }}</th>
                                <th>{{ trans('admin/roles/general.columns.description') }}</th>
                                <th>{{ trans('admin/roles/general.columns.permissions') }}</th>
                                <th>{{ trans('admin/roles/general.columns.users') }}</th>
                                <th>{{ trans('admin/roles/general.columns.created') }}</th>
                                <th>{{ trans('admin/roles/general.columns.updated') }}</th>
                                <th>{{ trans('admin/roles/general.columns.actions') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ trans('admin/roles/general.columns.name') }}</th>
                                <th>{{ trans('admin/roles/general.columns.display_name') }}</th>
                                <th>{{ trans('admin/roles/general.columns.description') }}</th>
                                <th>{{ trans('admin/roles/general.columns.permissions') }}</th>
                                <th>{{ trans('admin/roles/general.columns.users') }}</th>
                                <th>{{ trans('admin/roles/general.columns.created') }}</th>
                                <th>{{ trans('admin/roles/general.columns.updated') }}</th>
                                <th>{{ trans('admin/roles/general.columns.actions') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{!! link_to_route('admin.roles.show', $role->name, [$role->id], []) !!}</td>
                                    <td>{!! link_to_route('admin.roles.show', $role->display_name, [$role->id], []) !!}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>{{ $role->perms->count() }}</td>
                                    <td>{{ $role->users->count() }}</td>
                                    <td>{{ $role->created_at->diffForHumans() }}</td>
                                    <td>{{ $role->updated_at->diffForHumans() }}</td>
                                    <td>
                                        @if ( $role->isEditable() || $role->canChangePermissions() )
                                            <a href="{!! route('admin.roles.edit', $role->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                        @else
                                            <i class="fa fa-pencil-square-o text-muted" title="{{ trans('admin/roles/general.error.cant-edit-this-role') }}"></i>
                                        @endif

                                        @if ( $role->isDeletable() )
                                            <a href="{!! route('admin.roles.confirm-delete', $role->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o"></i></a>
                                        @else
                                            <i class="fa fa-trash-o text-muted" title="{{ trans('admin/roles/general.error.cant-delete-this-role') }}"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $roles->render() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection
