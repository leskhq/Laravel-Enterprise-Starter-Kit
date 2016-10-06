@extends('layouts.master')

@section('head_extra')
    <style>
        /* Side notes for calling out things
        -------------------------------------------------- */

        /* Base styles (regardless of theme) */
        .bs-callout {
          margin: 20px 0;
          padding: 15px 30px 15px 15px;
          border-left: 5px solid #eee;
          border: 1px solid #eee;
          border-left-width: 5px;
        }
        .bs-callout h4 {
          margin-top: 0;
        }
        .bs-callout p:last-child {
          margin-bottom: 0;
        }
        .bs-callout code,
        .bs-callout .highlight {
          background-color: #fff;
        }

        /* Themes for different contexts */
        .bs-callout-danger {
          border-left-color: #dFb5b4;
        }
        .bs-callout-warning {
          border-left-color: #f1e7bc;
        }
        .bs-callout-info {
          border-left-color: #1b809e;
        }
    </style>
@endsection

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">
                Customer ({{ $customers->count() }})
            </a></li>
            <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">
                Calon Customer ({{ $customerCandidates->count() }})
            </a></li>
            <li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">
                Barang ({{ $products->count() }})
            </a></li>
            <li class="pull-left header"><i class="fa fa-th"></i> Results</li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1-1">
                @if($customers->count())
                    @foreach($customers as $customer)
                        <div class="bs-callout bs-callout-info">
                            <h4>{!! link_to_route('admin.customers.show', $customer->name, $customer->id) !!}</h4>
                            <p>{{ $customer->laundry_address ? $customer->laundry_address : $customer->address }} {{ $customer->phone }} {{ $customer->email }}</p>
                        </div>
                    @endforeach
                @else
                    tidak ada customer yang pake kata <b>"{{ $keyword }}"</b>
                @endif
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2-2">
                @if($customerCandidates->count())
                    @foreach($customerCandidates as $c)
                        <div class="bs-callout bs-callout-info">
                            <h4>{!! link_to_route('admin.customer-candidates.show', $c->name, $c->id) !!}</h4>
                            <p>{{ $c->address }} {{ $c->phone }} {{ $c->email }}</p>
                        </div>
                    @endforeach
                @else
                    tidak ada calon customer yang pake kata <b>"{{ $keyword }}"</b>
                @endif
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3-2">
                    @if($products->count())
                        @foreach($products as $product)
                            <div class="bs-callout bs-callout-info">
                                <h4>{!! link_to_route('admin.products.edit', $product->name, $product->id) !!}</h4>
                                <p> Price: {{ Helpers::reggo($product->price) }} Agen Resmi Price: {{ Helpers::reggo($product->agenresmi_price) }} Agen Lepas Price: {{ Helpers::reggo($product->agenlepas_price) }}</p>
                            </div>
                        @endforeach
                    @else
                        tidak ada produk yang pake kata <b>"{{ $keyword }}"</b>
                    @endif
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
@endsection