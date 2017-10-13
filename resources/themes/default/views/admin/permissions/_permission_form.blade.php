<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs" id="tabWithState">
        <li class="active"><a href="#permission_tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
        <li class=""><a href="#permission_tab_options" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.options') !!}</a></li>
        <li class=""><a href="#permission_tab_routes" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.routes') !!}</a></li>
        <li class=""><a href="#permission_tab_roles" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.roles') !!}</a></li>
        <li class=""><a href="#permission_tab_users" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.users') !!}</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="permission_tab_details">
            <div class="form-group">
                {!! Form::label('name', trans('admin/permissions/general.columns.name')) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('display_name', trans('admin/permissions/general.columns.display_name')) !!}
                {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', trans('admin/permissions/general.columns.description')) !!}
                {!! Form::text('description', null, ['class' => 'form-control']) !!}
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="permission_tab_options">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {!! '<input type="hidden" name="enabled" value="0">' !!}
                        {!! Form::checkbox('enabled', '1', $perm->enabled) !!} {!! trans('general.status.enabled') !!}
                    </label>
                </div>
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="permission_tab_routes">
            <div class="form-group">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>{!! trans('admin/routes/general.columns.name')  !!}</th>
                            <th>{!! trans('admin/routes/general.columns.method')  !!}</th>
                            <th>{!! trans('admin/routes/general.columns.path')  !!}</th>
                            <th>{!! trans('admin/routes/general.columns.action_name')  !!}</th>
                            <th>{!! trans('admin/routes/general.columns.assigned')  !!}</th>
                            <th>{!! trans('admin/routes/general.columns.enabled')  !!}</th>
                        </tr>
                        @foreach($routes as $route)
                            <tr>
                                <td>{!! link_to_route('admin.routes.show', ($route->name)?$route->name:'', [$route->id], []) !!}</td>
                                <td>{!! link_to_route('admin.routes.show', $route->method, [$route->id], []) !!}</td>
                                <td>{!! link_to_route('admin.routes.show', $route->path, [$route->id], []) !!}</td>
                                <td>{!! link_to_route('admin.routes.show', \App\Libraries\Str::head_and_tail($route->action_name,30), [$route->id], []) !!}</td>
                                <td>
                                    @if($perm->routes->contains($route->id))
                                        {!! Form::checkbox('routes[]', $route->id, true) !!}
                                    @else
                                        {!! Form::checkbox('routes[]', $route->id, false) !!}
                                    @endif
                                </td>
                                <td>
                                    @if($route->enabled)
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

        <div class="tab-pane" id="permission_tab_roles">
            <div class="form-group">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>{!! trans('admin/users/general.columns.name')  !!}</th>
                            <th>{!! trans('admin/users/general.columns.description')  !!}</th>
                            <th>{!! trans('admin/users/general.columns.assigned')  !!}</th>
                            <th>{!! trans('admin/users/general.columns.enabled')  !!}</th>
                        </tr>
                        @foreach($roles as $role)
                            <tr>
                                <td>{!! link_to_route('admin.roles.show', $role->display_name, [$role->id], []) !!}</td>
                                <td>{!! link_to_route('admin.roles.show', $role->description, [$role->id], []) !!}</td>
                                <td>
                                    @if($perm->roles->contains($role->id))
                                        {!! Form::checkbox('roles[]', $role->id, true) !!}
                                    @else
                                        {!! Form::checkbox('roles[]', $role->id, false) !!}
                                    @endif
                                </td>
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

        <div class="tab-pane" id="permission_tab_users">
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
                                    @if($perm->users->contains($user->id))
                                        {!! Form::checkbox('users[]', $user->id, true) !!}
                                    @else
                                        {!! Form::checkbox('users[]', $user->id, false) !!}
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
