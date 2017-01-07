 <div class="form-group">
    {!! Form::label('packet_id', 'Paket', ['class' => 'control-label']) !!}
    {!! Form::select('packet_id', [null => 'pilih paket'] + $packets, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('commitment_fee', 'Commitment Fee', ['class' => 'control-label']) !!}
    {!! Form::text('commitment_fee', null, ['class' => 'form-control date']) !!}
</div>

<div class="form-group">
    {!! Form::label('first_payment', 'Pembayaran Pertama', ['class' => 'control-label']) !!}
    {!! Form::text('first_payment', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('first_pay', 'Tanggal Pembayaran Pertama', ['class' => 'control-label']) !!}
    {!! Form::text('first_pay', null, ['class' => 'form-control date']) !!}
</div>

<div class="form-group">
    {!! Form::label('second_payment', 'Pembayaran Kedua', ['class' => 'control-label']) !!}
    {!! Form::text('second_payment', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('settled', 'Pelunasan', ['class' => 'control-label']) !!}
    {!! Form::text('settled', null, ['class' => 'form-control date']) !!}
</div>

<div class="form-group">
    {!! Form::label('addition', 'Tambahan', ['class' => 'control-label']) !!}
    {!! Form::text('addition', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Deskripsi', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'size' => '30x5']) !!}
</div>
