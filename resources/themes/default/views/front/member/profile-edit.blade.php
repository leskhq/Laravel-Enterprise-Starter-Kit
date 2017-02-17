<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(['url' => 'updateUser', 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
        <fieldset>
            @if($user->hasRole('members'))
            <div class="form-group">
                {!! Form::label('phone', 'Telpon', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('phone', $user->storeCustomer->phone, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('address', 'Alamat', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::textarea('address', $address, ['rows' => 3, 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('prov', 'Provinsi', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::select('prov', ['default' => 'pilih provinsi'] + $prov, 'default', ['id' => 'prov', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('kokab', 'Kota Kabupaten', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::select('kokab', ['default' => 'kota'], 'default', ['id' => 'kokab', 'class' => 'form-control']) !!}
                </div>
            </div>
            @endif
            <div class="col-md-4 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>