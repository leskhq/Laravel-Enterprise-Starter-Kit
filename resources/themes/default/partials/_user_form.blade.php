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
    {{ trans('admin/users/general.columns.roles') }}
    @foreach($roles as $role)
        <div class="checkbox">
            <label>
                {!! Form::checkbox('role[]', $role->id, $user->hasRole($role->name), (\App\Models\Role::isForced($role))? ['disabled'] : null ) !!} {{ $role->display_name }}
            </label>
        </div>
    @endforeach
</div>
