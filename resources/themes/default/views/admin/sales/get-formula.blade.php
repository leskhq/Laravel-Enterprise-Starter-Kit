@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Collapsible Accordion</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        @foreach($data as $product => $saleDetail)
                        <div class="panel box box-{{ isset($saleDetail['materials']) ? 'primary' : 'danger' }}">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $x }}">
                                    {{ $product }}
                                    </a>
                                </h4>
                                <div class="pull-right">
                                    <span class="badge">{{ $saleDetail['quantity'] }}</span>
                                </div>
                            </div>
                            <?php if( isset($saleDetail['materials']) ) : ?>
                            <div id="collapse{{ $x }}" class="panel-collapse collapse">
                                <div class="box-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('admin/formulas/general.columns.materials') }}</th>
                                                <th>{{ trans('admin/formulas/general.columns.quantity') }}</th>
                                                <th>{{ trans('admin/formulas/general.columns.total') }}</th>
                                            </tr>
                                        </thead>
                                        @foreach($saleDetail['materials'] as $type => $val)
                                            <?php
                                                if ( isset($total[$val['material_id']]) ) {
                                                    $total[$val['material_id']] += $val['quantity'] * $saleDetail['quantity'];
                                                } else {
                                                    $total[$val['material_id']] = 0 + $val['quantity'] * $saleDetail['quantity'];
                                                }
                                            ?>
                                            <tr>
                                                <td>{{ Helpers::getMaterialById($val['material_id'])->name }}</td>
                                                <td>{{ $val['quantity'] }}</td>
                                                <td>{{ $val['quantity'] * $saleDetail['quantity'] }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <?php endif; $x++ ?>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-default" disabled><i class="fa fa-print"></i> Print</a>
            <a href="#" class="btn btn-default" disabled><i class="fa fa-print"></i> Print</a>
            <a href="#" class="btn btn-default" disabled><i class="fa fa-print"></i> Print</a>
            <a href="{{ route('admin.sales.show', $sale->id) }}" class="btn btn-default"><i class="fa fa-times"></i> Close</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Collapsible Accordion</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('admin/formulas/general.columns.materials') }}</th>
                                <th>{{ trans('admin/formulas/general.columns.total') }}</th>
                                <th>{{ trans('admin/formulas/general.columns.stock') }}</th>
                                <th>{{ trans('admin/formulas/general.columns.need') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($total as $material => $value)
                            <tr>
                                <td>{{ Helpers::getMaterialById($material)->name }}</td>
                                <td>{{ $value }}</td>
                                <td>{{ Helpers::getMaterialById($material)->stock }}</td>
                                <td>{{ Helpers::getMaterialById($material)->stock - $value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
@endsection