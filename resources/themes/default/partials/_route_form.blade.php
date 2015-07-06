<div class="form-group">
    {!! Form::label('method', trans('admin/routes/general.columns.method')) !!}
    {!! Form::text('method', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('path', trans('admin/routes/general.columns.path')) !!}
    {!! Form::text('path', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', trans('admin/routes/general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('action_name', trans('admin/routes/general.columns.action_name')) !!}
    {!! Form::text('action_name', null, ['class' => 'form-control']) !!}
</div>
