<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
        <li class=""><a href="#tab_options" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.options') !!}</a></li>
        <li class=""><a href="#tab_roles" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.roles') !!}</a></li>
        <li class=""><a href="#tab_perms" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.perms') !!}</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="tab_details">
            <div class="form-group">
                {!! Form::label('first_name', trans('admin/users/general.columns.first_name')) !!}
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('last_name', trans('admin/users/general.columns.last_name')) !!}
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('username', trans('admin/users/general.columns.username')) !!}
                {!! Form::text('username', null, ['class' => 'form-control']) !!}
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

        <div class="tab-pane" id="tab_options">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <!-- Trick to force cleared checkbox to being posted in form! It will be posted as zero unless checked then posted again as 1 and since only last one count! -->
                        {!! '<input type="hidden" name="enabled" value="0">' !!}
                        {!! Form::checkbox('enabled', '1', $user->enabled) !!} {!! trans('general.status.enabled') !!}
                    </label>
                </div>
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_roles">
            <div class="form-group">
                {!! Form::hidden('selected_roles', null, [ 'id' => 'selected_roles']) !!}
                <div class="input-group select2-bootstrap-append">
                    {!! Form::select('role_search', [], null, ['class' => 'form-control', 'id' => 'role_search',  'style' => "width: 100%"]) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-default"  id="btn-add-role" type="button">
                            <span class="fa fa-plus-square"></span>
                        </button>
                    </span>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="tbl-roles">
                        <tbody>
                        <tr>
                            <th class="hidden" rowname="id">{!! trans('admin/roles/general.columns.id')  !!}</th>
                            <th>{!! trans('admin/roles/general.columns.name')  !!}</th>
                            <th>{!! trans('admin/roles/general.columns.description')  !!}</th>
                            <th>{!! trans('admin/roles/general.columns.enabled')  !!}</th>
                            <th style="text-align: right">{!! trans('admin/roles/general.columns.actions')  !!}</th>
                        </tr>
                        @foreach($user->roles as $role)
                            <tr>
                                <td class="hidden" rowname="id">{!! $role->id !!}</td>
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
                                    <a class="btn-remove-role" href="#" title="{{ trans('general.button.remove-role') }}"><i class="fa fa-trash-o deletable"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
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
                                    {!! Form::checkbox('perms[]', $perm->id, $user->hasPermission($perm->name)) !!}
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
