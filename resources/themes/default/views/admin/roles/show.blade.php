@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model($role, ['route' => ['admin.roles.edit', $role->id], 'method' => 'POST', 'id' => 'form_show_role']) !!}

                    {!! Form::hidden('redirects_to', $previousURL, ['id' => 'redirects_to']) !!}

                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" id="tabWithState">
                            <li class="active"><a href="#role_tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
                            <li class=""><a href="#role_tab_options" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.options') !!}</a></li>
                            <li class=""><a href="#role_tab_perms" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.perms') !!}</a></li>
                            <li class=""><a href="#role_tab_users" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.users') !!}</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="role_tab_details">
                                <div class="form-group">
                                    {!! Form::label('name', trans('admin/roles/general.columns.name')) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('display_name', trans('admin/roles/general.columns.display_name')) !!}
                                    {!! Form::text('display_name', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('description', trans('admin/roles/general.columns.description')) !!}
                                    {!! Form::text('description', null, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="role_tab_options">

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('resync_on_login', '1', $role->resync_on_login, ['disabled']) !!} {!! trans('admin/roles/general.columns.resync_on_login') !!}
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('enabled', '1', $role->enabled, ['disabled']) !!} {!! trans('general.status.enabled') !!}
                                        </label>
                                    </div>
                                </div>

                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="role_tab_perms">
                                <div class="form-group">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr>
                                                <th>{!! trans('admin/permissions/general.columns.name')  !!}</th>
                                                <th>{!! trans('admin/permissions/general.columns.description')  !!}</th>
                                                <th>{!! trans('admin/permissions/general.columns.assigned')  !!}</th>
                                                <th>{!! trans('admin/permissions/general.columns.enabled')  !!}</th>
                                            </tr>
                                            @foreach($permissions as $perm)

                                                @switch($perm->name)
                                                    @case("core.guest-only")
                                                    @case("core.open-to-all")
                                                    @case("core.basic-authenticated")
                                                        <!-- Skipping perm: {{$perm->name}} -->
                                                        @break

                                                    @default
                                                        <tr>
                                                            <td>{!! link_to_route('admin.permissions.show', $perm->display_name, [$perm->id], []) !!}</td>
                                                            <td>{!! link_to_route('admin.permissions.show', $perm->description,  [$perm->id], []) !!}</td>
                                                            <td>
                                                                @if($role->permissions->contains($perm->id))
                                                                    <i class="fa fa-check text-green"></i>
                                                                @else
                                                                    <i class="fa fa-close text-red"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($perm->enabled)
                                                                    <i class="fa fa-check text-green"></i>
                                                                @else
                                                                    <i class="fa fa-close text-red"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                @endswitch

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="role_tab_users">
                                <div class="form-group">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr>
                                                <th>{!! trans('admin/users/general.columns.username')  !!}</th>
                                                <th>{!! trans('admin/users/general.columns.first_name')  !!}</th>
                                                <th>{!! trans('admin/users/general.columns.last_name')  !!}</th>
                                                <th>{!! trans('admin/users/general.columns.email')  !!}</th>
                                                <th>{!! trans('admin/users/general.columns.assigned')  !!}</th>
                                                <th>{!! trans('admin/users/general.columns.enabled')  !!}</th>
                                            </tr>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{!! link_to_route('admin.users.show', $user->username,   [$user->id], []) !!}</td>
                                                    <td>{!! link_to_route('admin.users.show', $user->first_name, [$user->id], []) !!}</td>
                                                    <td>{!! link_to_route('admin.users.show', $user->last_name,  [$user->id], []) !!}</td>
                                                    <td>{!! link_to_route('admin.users.show', $user->email,      [$user->id], []) !!}</td>
                                                    <td>
                                                        @if($role->users->contains($user->id))
                                                            <i class="fa fa-check text-green"></i>
                                                        @else
                                                            <i class="fa fa-close text-red"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($user->enabled)
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

                        </div><!-- /.tab-content -->
                    </div>

                    <div class="form-group">
                        {!! Form::button(trans('general.button.close'), ['class' => 'btn btn-primary', 'id' => 'btn-close-show']) !!}
                        {!! Form::button(trans('general.button.edit'),  ['class' => 'btn btn-default', 'id' => 'btn-call-edit']) !!}
                    </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
    @include('partials.body_bottom_tab_with_state_set_js')

    <script type="text/javascript">
        $("#btn-close-show").on("click", function () {
            // Return to page stored in redirect hidden field.
            window.location.href = $("#redirects_to").val();
        });


        $("#btn-call-edit").on("click", function () {
            $("#form_show_role").submit();
        });
    </script>

@endsection
