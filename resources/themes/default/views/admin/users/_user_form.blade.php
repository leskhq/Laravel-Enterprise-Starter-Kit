<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs" id="tabWithState">
        <li class="active"><a href="#user_tab_profile" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.profile') !!}</a></li>
        <li class=""><a href="#user_tab_settings" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.settings') !!}</a></li>
        <li class=""><a href="#user_tab_roles" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.roles') !!}</a></li>
        <li class=""><a href="#user_tab_perms" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.perms') !!}</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="user_tab_profile">
            <div class="form-group">
                {!! Form::label('first_name', trans('admin/users/general.columns.first_name')) !!}
                @if ( $user->isRoot() )
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'readonly']) !!}
                @else
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('last_name', trans('admin/users/general.columns.last_name')) !!}
                @if ( $user->isRoot() )
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'readonly']) !!}
                @else
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('username', trans('admin/users/general.columns.username')) !!}
                @if ( $user->isRoot() )
                    {!! Form::text('username', null, ['class' => 'form-control', 'readonly']) !!}
                @else
                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('email', trans('admin/users/general.columns.email')) !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', trans('admin/users/general.columns.password')) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', trans('admin/users/general.columns.password_confirmation')) !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('auth_type', trans('admin/users/general.columns.type')) !!}
                {!! Form::text('auth_type', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="user_tab_settings">

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <!-- Trick to force cleared checkbox to being posted in form! It will be posted as zero unless checked then posted again as 1 and since only last one count! -->
                        {!! '<input type="hidden" name="enabled" value="0">' !!}
                        @if ( $user->isRoot() )
                            {!! Form::checkbox('enabled', '1', $user->enabled, ['disabled']) !!} {!! trans('general.status.enabled') !!}
                        @else
                            {!! Form::checkbox('enabled', '1', $user->enabled) !!} {!! trans('general.status.enabled') !!}
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('settings[theme.default]', trans('admin/users/general.columns.theme')) !!}
                {!! Form::select( 'settings[theme.default]', $themes, $user->settings()->get('theme.default', null), [ 'class' => 'select-theme', 'placeholder' => trans('admin/users/general.placeholder.select-theme') ] ) !!}</td>
            </div>

            <div class="form-group">
                {!! Form::label('settings[app.timezone]', trans('admin/users/general.columns.time_zone')) !!}
                {!! Form::select( 'settings[app.timezone]', $timezones, $tzKey, [ 'class' => 'select-time_zone', 'placeholder' => trans('admin/users/general.placeholder.select-time_zone') ] ) !!}</td>
            </div>

            <div class="form-group">
                {!! '<input type="hidden" name="settings[app.time_format]" value="">' !!}
                {!! Form::label('settings[app.time_format]', trans('admin/users/general.columns.time_format')) !!}&nbsp;
                <label class="radio-inline"><input type="radio" name="settings[app.time_format]" value="12" {{("12"==$time_format)?'checked="checked"':''}}>{{trans('admin/users/general.options.12_hours')}}</label>
                <label class="radio-inline"><input type="radio" name="settings[app.time_format]" value="24" {{("24"==$time_format)?'checked="checked"':''}}>{{trans('admin/users/general.options.24_hours')}}</label>
            </div>

            <div class="form-group">
                {!! Form::label('settings[app.locale]', trans('admin/users/general.columns.locale')) !!}
                {!! Form::select( 'settings[app.locale]', $locales, $user->settings()->get('app.locale', null), [ 'class' => 'select-locale', 'placeholder' => trans('admin/users/general.placeholder.select-locale') ] ) !!}</td>
            </div>

        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="user_tab_roles">
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
                                <td>{!! link_to_route('admin.roles.show', $role->description,  [$role->id], []) !!}</td>
                                <td>
                                    @if ( $user->isRoot() )
                                        {!! Form::checkbox('roles[]', $role->id, true, ['disabled']) !!}
                                    @else
                                        @if($user->roles->contains($role->id))
                                            {!! Form::checkbox('roles[]', $role->id, true) !!}
                                        @else
                                            {!! Form::checkbox('roles[]', $role->id, false) !!}
                                        @endif
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
                </div>
            </div>

        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="user_tab_perms">
            <div class="form-group">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>{!! trans('admin/users/general.columns.name')  !!}</th>
                            <th>{!! trans('admin/users/general.columns.description')  !!}</th>
                            <th>{!! trans('admin/users/general.columns.assigned')  !!}</th>
                            <th>{!! trans('admin/users/general.columns.effective')  !!}</th>
                            <th>{!! trans('admin/users/general.columns.enabled')  !!}</th>
                        </tr>
                        @foreach($perms as $perm)
                            <tr>
                                <td>{!! link_to_route('admin.permissions.show', $perm->display_name, [$perm->id], []) !!}</td>
                                <td>{!! link_to_route('admin.permissions.show', $perm->description,  [$perm->id], []) !!}</td>
                                <td>
                                    @if ( $user->isRoot() )
                                        {!! Form::checkbox('perms[]', $perm->id, true, ['disabled']) !!}
                                    @else
                                        @if($user->permissions->contains($perm->id))
                                            {!! Form::checkbox('perms[]', $perm->id, true) !!}
                                        @else
                                            {!! Form::checkbox('perms[]', $perm->id, false) !!}
                                        @endif
                                    @endif

                                </td>
                                <td>
                                    @if($user->can($perm->name))
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
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div>
