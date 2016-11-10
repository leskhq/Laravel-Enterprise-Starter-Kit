<div class="form-group">
    <label for="category">{!! trans('admin/users/general.columns.id') !!}</label>
    <input class="form-control" readonly="readonly" name="id" type="text" value="{!! $dataArray['id'] !!}" id="id">
</div>

<div class="form-group">
    <label for="category">{!! trans('admin/users/general.columns.first_name') !!}</label>
    <input class="form-control" readonly="readonly" name="first_name" type="text" value="{!! $dataArray['first_name'] !!}" id="first_name">
</div>

<div class="form-group">
    <label for="category">{!! trans('admin/users/general.columns.last_name') !!}</label>
    <input class="form-control" readonly="readonly" name="last_name" type="text" value="{!! $dataArray['last_name'] !!}" id="last_name">
</div>

<div class="form-group">
    <label for="category">{!! trans('admin/users/general.columns.username') !!}</label>
    <input class="form-control" readonly="readonly" name="username" type="text" value="{!! $dataArray['username'] !!}" id="username">
</div>

<div class="form-group">
    <label for="category">{!! trans('admin/users/general.columns.email') !!}</label>
    <input class="form-control" readonly="readonly" name="email" type="text" value="{!! $dataArray['email'] !!}" id="email">
</div>

<div class="form-group">
    <label for="category">{!! trans('admin/users/general.columns.type') !!}</label>
    <input class="form-control" readonly="readonly" name="auth_type" type="text" value="{!! $dataArray['auth_type'] !!}" id="auth_type">
</div>

<div class="form-group">
    <label for="category">{!! trans('admin/users/general.columns.enabled') !!}</label>
    <input class="form-control" readonly="readonly" name="enabled" type="text" value="{!! ($dataArray['enabled']) ? 'TRUE' : 'FALSE' !!}" id="enabled">
</div>

@if (array_key_exists('permsObj', $dataArray) && (!empty($dataArray['permsObj'])))
    <div class="form-group">
        <label for="category">{!! trans('admin/users/general.columns.permissions') !!}</label>
        @foreach($dataArray['permsObj'] as $perm)
            <div class="checkbox">
                <label>
                    <input disabled="disabled" name="{!! $perm->name !!}" type="checkbox" value="1"> {!! "$perm->name (#$perm->id)" !!}
                </label>
            </div>
        @endforeach
    </div>
@endif

@if (array_key_exists('permsNotFound', $dataArray) && (!empty($dataArray['permsNotFound'])))
    <div class="form-group">
        <label for="category">{!! trans('admin/users/general.columns.permissions-not-found') !!}</label>
        @foreach($dataArray['permsNotFound'] as $msg)
            <div class="checkbox">
                <label>
                    <input disabled="disabled" name="perm_not_found" type="checkbox" value="1"> {!! $msg !!}
                </label>
            </div>
        @endforeach
    </div>
@endif

@if (array_key_exists('rolesObj', $dataArray) && (!empty($dataArray['rolesObj'])))
    <div class="form-group">
        <label for="category">{!! trans('admin/users/general.columns.roles') !!}</label>
        @foreach($dataArray['rolesObj'] as $role)
            <div class="checkbox">
                <label>
                    <input disabled="disabled" name="{!! $role->name !!}" type="checkbox" value="1"> {!! "$role->name (#$role->id)" !!}
                </label>
            </div>
        @endforeach
    </div>
@endif

@if (array_key_exists('rolesNotFound', $dataArray) && (!empty($dataArray['rolesNotFound'])))
    <div class="form-group">
        <label for="category">{!! trans('admin/users/general.columns.roles-not-found') !!}</label>
        @foreach($dataArray['rolesNotFound'] as $msg)
            <div class="checkbox">
                <label>
                    <input disabled="disabled" name="role_not_found" type="checkbox" value="1"> {!! $msg !!}
                </label>
            </div>
        @endforeach
    </div>
@endif
