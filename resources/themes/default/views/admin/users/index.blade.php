@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.users.enable-selected', 'id' => 'frmUserList') ) !!}
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/users/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.users.create') !!}" title="{{ trans('admin/users/general.button.create') }}">
                        <i class="fa fa-plus-square"></i>
                    </a>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmUserList'].action = '{!! route('admin.users.enable-selected') !!}';  document.forms['frmUserList'].submit(); return false;" title="{{ trans('general.button.enable') }}">
                        <i class="fa fa-check-circle-o"></i>
                    </a>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmUserList'].action = '{!! route('admin.users.disable-selected') !!}';  document.forms['frmUserList'].submit(); return false;" title="{{ trans('general.button.disable') }}">
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
                                    <th>{{ trans('admin/users/general.columns.gravatar') }}</th>
                                    <th>{{ trans('admin/users/general.columns.username') }}</th>
                                    <th>{{ trans('admin/users/general.columns.name') }}</th>
                                    <th>{{ trans('admin/users/general.columns.roles') }}</th>
                                    <th>{{ trans('admin/users/general.columns.email') }}</th>
                                    <th>{{ trans('admin/users/general.columns.type') }}</th>
                                    <th>{{ trans('admin/users/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center">
                                        <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>
                                    </th>
                                    <th>{{ trans('admin/users/general.columns.gravatar') }}</th>
                                    <th>{{ trans('admin/users/general.columns.username') }}</th>
                                    <th>{{ trans('admin/users/general.columns.name') }}</th>
                                    <th>{{ trans('admin/users/general.columns.roles') }}</th>
                                    <th>{{ trans('admin/users/general.columns.email') }}</th>
                                    <th>{{ trans('admin/users/general.columns.type') }}</th>
                                    <th>{{ trans('admin/users/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td align="center">
                                            @if ($user->canBeDisabled())
                                                {!! Form::checkbox('chkUser[]', $user->id); !!}
                                            @endif
                                        </td>
                                        <td><img src="{{ Gravatar::get($user->email , 'tiny') }}" class="user-image" alt="User Image"/></td>
                                        <td>{!! link_to_route('admin.users.show', $user->username, [$user->id], []) !!}</td>
                                        <td>{!! link_to_route('admin.users.show', $user->full_name, [$user->id], []) !!}</td>
                                        <td>{{ $user->roles->count() }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->auth_type }}</td>
                                        <td>
                                            <a href="{!! route('admin.users.edit', $user->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>

                                            @if ($user->canBeDisabled())
                                                @if ( $user->enabled )
                                                    <a href="{!! route('admin.users.disable', $user->id) !!}" title="{{ trans('general.button.disable') }}"><i class="fa fa-check-circle-o enabled"></i></a>
                                                @else
                                                    <a href="{!! route('admin.users.enable', $user->id) !!}" title="{{ trans('general.button.enable') }}"><i class="fa fa-ban disabled"></i></a>
                                                @endif
                                            @else
                                                    <i class="fa fa-ban text-muted" title="{{ trans('admin/users/general.error.cant-be-disabled') }}"></i>
                                            @endif

                                            @if ( $user->isDeletable() )
                                                <a href="{!! route('admin.users.confirm-delete', $user->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                            @else
                                                <i class="fa fa-trash-o text-muted" title="{{ trans('admin/users/general.error.cant-be-deleted') }}"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $users->render() !!}
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
            checkboxes = document.getElementsByName('chkUser[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>
@endsection
