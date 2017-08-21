@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model($user, ['route' => 'admin.users.index', 'method' => 'GET']) !!}

                <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_profile" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.profile') !!}</a></li>
                            <li class=""><a href="#tab_settings" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.settings') !!}</a></li>
                            <li class=""><a href="#tab_roles" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.roles') !!}</a></li>
                            <li class=""><a href="#tab_perms" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.perms') !!}</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_profile">
                                <div class="form-group">
                                    {!! Form::label('first_name', trans('admin/users/general.columns.first_name')) !!}
                                    {!! Form::text('first_name', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('last_name', trans('admin/users/general.columns.last_name')) !!}
                                    {!! Form::text('last_name', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('username', trans('admin/users/general.columns.username')) !!}
                                    {!! Form::text('username', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email', trans('admin/users/general.columns.email')) !!}
                                    {!! Form::text('email', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('auth_type', trans('admin/users/general.columns.type')) !!}
                                    {!! Form::text('auth_type', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_settings">

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('enabled', '1', $user->enabled, ['disabled']) !!} {!! trans('general.status.enabled') !!}
                                        </label>
                                    </div>
                                </div>

                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_roles">
                                <div class="form-group">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr>
                                                <th>{!! trans('admin/roles/general.columns.name')  !!}</th>
                                                <th>{!! trans('admin/roles/general.columns.description')  !!}</th>
                                                <th>{!! trans('admin/roles/general.columns.enabled')  !!}</th>
                                                <th style="text-align: right">{!! trans('admin/roles/general.columns.actions')  !!}</th>
                                            </tr>
                                            @foreach($user->roles as $role)
                                                <tr>
                                                    <td>{!! link_to_route('admin.roles.show', $role->display_name, [$role->id], []) !!}</td>
                                                    <td>{!! link_to_route('admin.roles.show', $role->description, [$role->id], []) !!}</td>
                                                    <td>
                                                        @if($role->enabled)
                                                            <i class="fa fa-check text-green"></i>
                                                        @else
                                                            <i class="fa fa-close text-red"></i>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: right">
                                                        <i class="fa fa-trash-o text-muted"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div><!-- /.table-responsive -->

                                </div><!-- /.form-group -->
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_perms">
                                <div class="form-group">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr>
                                                <th>{!! trans('admin/users/general.columns.name')  !!}</th>
                                                <th>{!! trans('admin/users/general.columns.assigned')  !!}</th>
                                            </tr>
                                            @foreach($permissions as $perm)
                                                <tr>
                                                    <td>{!! link_to_route('admin.permissions.show', $perm->display_name, [$perm->id], []) !!}</td>
                                                    <td>
                                                        @if($user->can($perm->name))
                                                            <i class="fa fa-check text-green"></i>
                                                        @else
                                                            <i class="fa fa-close text-red"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.tab-pane -->

                        </div><!-- /.tab-content -->
                    </div>

                    <div class="form-group">
                        {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('admin.users.edit', $user->id) !!}" title="{{ trans('general.button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                    </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
@endsection
