@extends('layouts.master')

@section('content')

    <h3>Customer</h3>
    @if($customers->count())
        @foreach($customers as $customer)
            <li>
                <h4>{!! link_to_route('admin.customers.show', $customer->name, $customer->id) !!}</h4>
            </li>
        @endforeach
    @else
        tidak ada customer yang pake kata <b>"{{ $keyword }}"</b>
    @endif

    <h3>Calon Customer</h3>
    @if($customerCandidates->count())
        @foreach($customerCandidates as $c)
            <li>
                <h4>{!! link_to_route('admin.customer-candidates.show', $c->name, $c->id) !!}</h4>
            </li>
        @endforeach
    @else
        tidak ada calon customer yang pake kata <b>"{{ $keyword }}"</b>
    @endif

    <h3>Barang</h3>
    @if($products->count())
        @foreach($products as $product)
            <li>
                <h4>{!! link_to_route('admin.products.edit', $product->name, $product->id) !!}</h4>
            </li>
        @endforeach
    @else
        tidak ada produk yang pake kata <b>"{{ $keyword }}"</b>
    @endif

@endsection