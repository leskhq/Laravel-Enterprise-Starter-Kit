@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/users/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.users.create') !!}" title="{{ trans('admin/users/general.button.create') }}">
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
                                <th>{{ trans('admin/users/general.columns.username') }}</th>
                                <th>{{ trans('admin/users/general.columns.name') }}</th>
                                <th>{{ trans('admin/users/general.columns.roles') }}</th>
                                <th>{{ trans('admin/users/general.columns.email') }}</th>
                                <th>{{ trans('admin/users/general.columns.created') }}</th>
                                <th>{{ trans('admin/users/general.columns.updated') }}</th>
                                <th>{{ trans('admin/users/general.columns.actions') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ trans('admin/users/general.columns.username') }}</th>
                                <th>{{ trans('admin/users/general.columns.name') }}</th>
                                <th>{{ trans('admin/users/general.columns.roles') }}</th>
                                <th>{{ trans('admin/users/general.columns.email') }}</th>
                                <th>{{ trans('admin/users/general.columns.created') }}</th>
                                <th>{{ trans('admin/users/general.columns.updated') }}</th>
                                <th>{{ trans('admin/users/general.columns.actions') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{!! link_to_route('admin.users.show', $user->username, [$user->id], []) !!}</td>
                                    <td>{!! link_to_route('admin.users.show', $user->full_name, [$user->id], []) !!}</td>
                                    <td>{{ $user->roles->count() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                                    <td>
                                        @if ( $user->isEditable() )
                                            <a href="{!! route('admin.users.edit', $user->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                        @else
                                            <i class="fa fa-pencil-square-o text-muted" title="{{ trans('admin/users/general.error.cant-be-edited') }}"></i>
                                        @endif
                                        @if ( $user->isDeletable() )
                                            <a href="{!! route('admin.users.confirm-delete', $user->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o"></i></a>
                                        @else
                                            <i class="fa fa-trash-o text-muted" title="{{ trans('admin/users/general.error.cant-be-deleted') }}"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $users->render() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection



