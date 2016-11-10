@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
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
                                {!! Form::label('password', trans('admin/users/general.columns.password')) !!}
                                {!! Form::password('password', ['class' => 'form-control', 'readonly']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password_confirmation', trans('admin/users/general.columns.password_confirmation')) !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'readonly']) !!}
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

                            <div class="form-group">
                                {!! Form::label('theme', trans('admin/users/general.columns.theme')) !!}
                                {!! Form::text('theme', $user->settings()->get('theme', null), ['class' => 'form-control', 'readonly']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('time_zone', trans('admin/users/general.columns.time_zone')) !!}
                                {!! Form::text('time_zone', $user->settings()->get('time_zone', null), ['class' => 'form-control', 'readonly']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('time_format', trans('admin/users/general.columns.time_format')) !!}&nbsp;
                                <label class="radio-inline"><input type="radio" name="time_format" value="12" {{("12"==$time_format)?'checked="checked"':''}} readonly="readonly">{{trans('admin/users/general.options.12_hours')}}</label>
                                <label class="radio-inline"><input type="radio" name="time_format" value="24" {{("24"==$time_format)?'checked="checked"':''}} readonly="readonly">{{trans('admin/users/general.options.24_hours')}}</label>
                            </div>

                            <div class="form-group">
                                {!! Form::label('locale', trans('admin/users/general.columns.locale')) !!}
                                {!! Form::text('locale', $locale, ['class' => 'form-control', 'readonly']) !!}
                            </div>

                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_roles">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-append">
                                    {!! Form::select('role_search', [], null, ['class' => 'form-control', 'id' => 'role_search', 'disabled' => 'disabled',  'style' => "width: 100%"]) !!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" disabled>
                                            <span class="fa fa-plus-square"></span>
                                        </button>
                                    </span>
                                </div>
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
                                                <th>{!! trans('admin/users/general.columns.effective')  !!}</th>
                                            </tr>
                                            @foreach($perms as $perm)
                                                <tr>
                                                    <td>{!! link_to_route('admin.permissions.show', $perm->display_name, [$perm->id], []) !!}</td>
                                                    <td>
                                                        @if($user->hasPermission($perm->name))
                                                            <i class="fa fa-check text-green"></i>
                                                        @else
                                                            <i class="fa fa-close text-red"></i>
                                                        @endif
                                                    </td>
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
    <!-- Select2 4.0.0 -->
    <script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

    <!-- Select2 js -->
    @include('partials._body_bottom_select2_js_role_search')
@endsection
