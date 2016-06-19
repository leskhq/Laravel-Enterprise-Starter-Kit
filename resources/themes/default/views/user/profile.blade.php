@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_profile" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.profile') !!}</a></li>
                        <li class=""><a href="#tab_roles" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.roles') !!}</a></li>
                        <li class=""><a href="#tab_perms" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.perms') !!}</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_profile">

                            {!! Form::model( $user, ['route' => ['user.profile.patch', $user->id], 'method' => 'PATCH', 'id' => 'form_edit_user'] ) !!}

                            <div class="form-group">
                                {!! Form::label('first_name', trans('admin/users/general.columns.first_name')) !!}
                                {!! Form::text('first_name', null, ['class' => 'form-control', $readOnlyIfLDAP]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('last_name', trans('admin/users/general.columns.last_name')) !!}
                                {!! Form::text('last_name', null, ['class' => 'form-control', $readOnlyIfLDAP]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('username', trans('admin/users/general.columns.username')) !!}
                                {!! Form::text('username', null, ['class' => 'form-control', $readOnlyIfLDAP]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', trans('admin/users/general.columns.email')) !!}
                                {!! Form::text('email', null, ['class' => 'form-control', $readOnlyIfLDAP]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', trans('admin/users/general.columns.password')) !!}
                                {!! Form::password('password', ['class' => 'form-control', $readOnlyIfLDAP]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password_confirmation', trans('admin/users/general.columns.password_confirmation')) !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', $readOnlyIfLDAP]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('auth_type', trans('admin/users/general.columns.type')) !!}
                                {!! Form::text('auth_type', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>

                            <div class="form-group">
                                @unless($readOnlyIfLDAP)
                                    {!! Form::submit( trans('general.button.update'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                                @endunless
                            </div>

                            {!! Form::close() !!}

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
                                        </tr>
                                        @foreach($user->roles as $role)
                                            <tr>
                                                <td>{!! $role->display_name !!}</td>
                                                <td>{!! $role->description !!}</td>
                                                <td>
                                                    @if($role->enabled)
                                                        <i class="fa fa-check text-green"></i>
                                                    @else
                                                        <i class="fa fa-close text-red"></i>
                                                    @endif
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
                                                <th>{!! trans('admin/roles/general.columns.description')  !!}</th>
                                                <th>{!! trans('admin/roles/general.columns.enabled')  !!}</th>
                                            </tr>
                                            @foreach($perms as $perm)
                                                @if($user->can($perm->name))
                                                    <tr>
                                                        <td>{!! $perm->display_name !!}</td>
                                                        <td>{!! $perm->description !!}</td>
                                                        <td>
                                                            @if($perm->enabled)
                                                                <i class="fa fa-check text-green"></i>
                                                            @else
                                                                <i class="fa fa-close text-red"></i>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                    </div><!-- /.tab-content -->
                </div>

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection

@section('body_bottom')
@endsection
