<div class="form-group">
    {!! Form::label('name', trans('admin/materials/general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('stock', trans('admin/materials/general.columns.stock')) !!}
    {!! Form::text('stock', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', trans('admin/materials/general.columns.price')) !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('min_stock', trans('admin/materials/general.columns.min_stock')) !!}
    {!! Form::text('min_stock', null, ['class' => 'form-control']) !!}
</div>