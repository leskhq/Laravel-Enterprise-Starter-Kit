@extends('layouts.master')

@section('content')
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Indotech Group
                <small class="pull-right">Date: {{ \Carbon\Carbon::now()->format('d M Y') }}</small>
            </h2>
        </div><!-- /.col -->
    </div>

    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Company
            <address>
              <strong>Laundry Cleanique</strong><br>
              Jl. Palagan KM. 9<br>
              Ngaglik Sleman, Yogyakarta 55581<br>
              Phone: 0274 2830339 <br>
              Email: mkt_orchid@yahoo.com
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Customer
            <address>
                <strong>{{ $sale->customer->name }}</strong><br>
                {{ $sale->address }}<br>
                {{ $sale->customer->getCustomerTypeDisplayName() }}<br>
                Phone: {{ $sale->phone }}<br>
                Email: {{ $sale->customer->email }}
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>{{ trans('admin/sales/general.columns.order_date') }}:</b>
            {{ Helpers::date($sale->order_date) }}
            <br>
            <br>
            <b>{{ trans('admin/sales/general.columns.transfer_date') }}:</b>
            {{ ($sale->transfer_date == '0000-00-00' || $sale->transfer_date == null) ? '' : Helpers::date($sale->transfer_date) }}
            <br>
            <b>{{ trans('admin/sales/general.columns.transfer_via') }}:</b> {{ $sale->transfer_via }}
            <br>
            <b>{{ trans('admin/sales/general.columns.ship_date') }}:</b>
            {{ ($sale->ship_date == '0000-00-00' || $sale->ship_date == null) ? '' : Helpers::date($sale->ship_date) }}
            <br>
            <b>{{ trans('admin/sales/general.columns.estimation_date') }}:</b>
            {{ ($sale->estimation_date == '0000-00-00' || $sale->estimation_date == null) ? '' : Helpers::date($sale->estimation_date) }}
            <br>
            <b>{{ trans('admin/sales/general.columns.expedition') }}:</b> {{ $sale->expedition }}
            <br>
            <b>{{ trans('admin/sales/general.columns.resi') }}:</b> {{ $sale->resi }}
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('admin/sales/detail.columns.quantity') }}</th>
                        <th>{{ trans('admin/sales/detail.columns.name') }}</th>
                        <th>{{ trans('admin/sales/detail.columns.description') }}</th>
                        <th>{{ trans('admin/sales/detail.columns.price') }}</th>
                        <th>{{ trans('admin/sales/detail.columns.total') }}</th>
                        <th>{{ trans('admin/sales/detail.columns.weight') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if( count($sale->saleDetails) )
                        <?php $totber = 0; $perlengkapan = 0; ?>
                        @foreach($sale->saleDetails->sortBy('product_id') as $d)
                            <?php $totber += $d->weight ?>
                            @if ( $d->product->category == 5 )
                                <?php $perlengkapan += $d->total; ?>
                            @endif
                            <tr>
                                <td>{{ $d->quantity }}</td>
                                <td>{{ $d->product->name }}</td>
                                <td>{{ $d->description }}</td>
                                <td>{{ Helpers::reggo($d->price) }}</td>
                                <td>{{ Helpers::reggo($d->total) }}</td>
                                <td>{{ $d->weight }}</td>
                            </tr>
                        @endforeach
                        <?php $sumber = $totber/40; ?>
                        <tr>
                            <td colspan="5">Berat Kemasan</td>
                            <td>{{ $totber }} Kg</td>
                        </tr>
                        <tr>
                            <td colspan="5">Berat Packing</td>
                            <td>{{ $sumber }} Kg</td>
                        </tr>
                        <tr>
                            <td colspan="5">Total Berat </td>
                            <td>{{ $totber+$sumber }} Kg</td>
                        </tr>
                    @else
                        nothing to show here.
                    @endif
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6"></div><!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">Amount Due {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">{{ trans('admin/sales/general.columns.nominal') }}:</th>
                        <td>{{ Helpers::reggo($sale->nominal) }}</td>
                    </tr>
                    <tr>
                        <th style="width:50%">{{ trans('admin/sales/general.columns.discount') }}:</th>
                        <td>{{ Helpers::reggo($sale->discount) }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('admin/sales/general.columns.packing_fee') }}:</th>
                        <td>{{ Helpers::reggo($sale->packing_fee) }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('admin/sales/general.columns.shipping_fee') }}:</th>
                        <td>{{ Helpers::reggo($sale->shipping_fee) }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('admin/sales/general.columns.total') }}:</th>
                        <td>{{
                            Helpers::reggo(($sale->nominal-$sale->discount) + $sale->shipping_fee + $sale->packing_fee)
                        }}</td>
                    </tr>
                </table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row no-print">
        <div class="col-xs-12">
            <a href="{{ route('admin.sales.print', $sale->id) }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <a href="#" class="btn btn-default"> Cetak Purchasing Order</a>
            <a href="{{ route('admin.sales.excel', $sale->id) }}" class="btn btn-success pull-right"><i class="fa fa-download"></i> Download Excel</a>
            <a href="{{ route('admin.sales.edit', $sale->id) }}" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-edit"></i> Edit</a>
        </div>
    </div>
@endsection
