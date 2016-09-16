<div class="input-group select2-bootstrap-append">
    {!! Form::label('type', trans('admin/customer-candidates/general.columns.type')) !!}
    {!! Form::select('type', config('constant.customer-types'), null, ['class' => 'form-control type',  'style' => "width: 100%"]) !!}
</div>

<div class="form-group">
    {!! Form::label('name', trans('admin/customers/general.columns.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', trans('admin/customers/general.columns.email')) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', trans('admin/customers/general.columns.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('laundry_name', trans('admin/customers/general.columns.laundry_name')) !!}
    {!! Form::text('laundry_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('laundry_address', trans('admin/customers/general.columns.laundry_address')) !!}
    {!! Form::textarea('laundry_address', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('admin/sales/general.columns.created')) !!}
    {!! Form::text('created_at', null, ['class' => 'form-control date']) !!}
</div>

<div class="form-group">
    <label>
        {!! '<input type="hidden" name="status" value="0">' !!}
        {!! Form::checkbox('status', '1', isset($customer) ? $customer->status:false, ['id' => 'status']) !!} {{ trans('admin/customers/general.columns.status') }}
    </label>
</div>

<div class="form-group">
    {!! Form::label('address', trans('admin/customers/general.columns.address')) !!}
    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<div class="form-group">
    {!! Form::label('send_address', trans('admin/customers/general.columns.send_address')) !!}
    {!! Form::textarea('send_address', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>
