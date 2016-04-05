<div class="form-group">
    {!! Form::label('name', trans('admin/expeditions/general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('contact', trans('admin/expeditions/general.columns.contact')) !!}
    {!! Form::textarea('contact', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('admin/expeditions/general.columns.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>