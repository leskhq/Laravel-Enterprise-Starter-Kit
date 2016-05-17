@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    @foreach($data as $product => $value)
        <h3>{{ $product }} <small>{{ $value['quantity'] }}</small></h3>
        <?php if( isset($value['materials']) ) : ?>
            @foreach($value['materials'] as $type => $val)
                <?php
                    if ( isset($total[$val['material_id']]) ) {
                        $total[$val['material_id']] += $val['quantity'] * $value['quantity'];
                    } else {
                        $total[$val['material_id']] = 0 + $val['quantity'] * $value['quantity'];
                    }
                ?>
                <h5>
                    {{ Helpers::getMaterialById($val['material_id'])->name }} - {{ $val['quantity'] }} * {{ $value['quantity'] }} = {{ $val['quantity']*$value['quantity'] }}
                </h5>
            @endforeach
        <?php endif; ?>
    @endforeach
    @foreach($total as $material => $value)
        <li>Total {{ Helpers::getMaterialById($material)->name }} : {{ $value }} Stock {{ Helpers::getMaterialById($material)->stock }} Butuh : {{ Helpers::getMaterialById($material)->stock - $value }}</li>
    @endforeach
@endsection

@section('body_bottom')
@endsection