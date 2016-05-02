<div class="form-group">
    {!! Form::label('name', trans('admin/outlets/general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', trans('admin/outlets/general.columns.email')) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', trans('admin/outlets/general.columns.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', trans('admin/outlets/general.columns.address')) !!}
    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>
