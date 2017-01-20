<div class="form-group">
    {!! Form::label('category_id', trans('admin/products/general.columns.category')) !!}
    {!! Form::select('category_id', config('constant.product-categories'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', trans('admin/products/general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('perfume_id', trans('admin/products/general.columns.perfume_id')) !!}
    {!! Form::select('perfume_id', ['null' => 'choose'] + $perfumes, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('stock', trans('admin/products/general.columns.stock')) !!}
    {!! Form::text('stock', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('weight', trans('admin/products/general.columns.weight')) !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('published', trans('admin/products/general.columns.published')) !!}
    {!! Form::select('published', config('constant.product-status'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('supplier_id', trans('admin/products/general.columns.supplier_id')) !!}
    {!! Form::hidden('supplier_id', null, ['id' => 'supplier_id']) !!}
    {!! Form::text('supplier', isset($product->supplier) ? $product->supplier->name : '', ['class' => 'form-control', 'id' => 'supplier']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('admin/products/general.columns.description')) !!}
    {!! Form::textarea('description', null, ['rows' => '3', 'class' => 'form-control']) !!}
</div>

<div class="input-group">
    <span class="input-group-addon">Rp.</span>
    {!! Form::text('hpp', null, ['placeholder' => trans('admin/products/general.columns.hpp'), 'class' => 'form-control']) !!}
    <span class="input-group-addon">.000</span>
</div>
<br>
<div class="input-group">
    <span class="input-group-addon">Rp.</span>
    {!! Form::text('agenresmi_price', null, ['placeholder' => trans('admin/products/general.columns.agenresmi_price'), 'class' => 'form-control']) !!}
    <span class="input-group-addon">.000</span>
</div>
<br>
<div class="input-group">
    <span class="input-group-addon">Rp.</span>
    {!! Form::text('agenlepas_price', null, ['placeholder' => trans('admin/products/general.columns.agenlepas_price'), 'class' => 'form-control']) !!}
    <span class="input-group-addon">.000</span>
</div>
<br>
<div class="input-group">
    <span class="input-group-addon">Rp.</span>
    {!! Form::text('price', null, ['placeholder' => trans('admin/products/general.columns.price'), 'class' => 'form-control']) !!}
    <span class="input-group-addon">.000</span>
</div>
<br>
<div class="form-group">
    {!! Form::label('image', trans('admin/products/general.columns.image')) !!}
    {!! Form::file('image') !!}
    <p class="help-block">cuma berlaku dengan *.jpg, *jpeg, *.png, *.bmp dan *.gif</p>
</div>
