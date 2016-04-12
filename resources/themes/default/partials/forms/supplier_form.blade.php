<div class="form-group">
    {!! Form::label('name', trans('admin/suppliers/general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('category', trans('admin/suppliers/general.columns.category')) !!}
    {!! Form::select('category', config('constant.supplier-categories'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('contact', trans('admin/suppliers/general.columns.contact')) !!}
    {!! Form::textarea('contact', null, ['rows'=>'3', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', trans('admin/suppliers/general.columns.address')) !!}
    {!! Form::textarea('address', null, ['rows'=>'3', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('admin/suppliers/general.columns.description')) !!}
    {!! Form::textarea('description', null, ['rows'=>'3', 'class' => 'form-control']) !!}
</div>
