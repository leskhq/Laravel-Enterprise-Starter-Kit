<div class="form-group">
    {!! Form::label('name', trans('admin/permissions/general.columns.name') ) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('display_name', trans('admin/permissions/general.columns.display_name') ) !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('admin/permissions/general.columns.description') ) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

