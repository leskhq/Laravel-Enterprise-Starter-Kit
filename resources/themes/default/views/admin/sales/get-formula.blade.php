@extends('layouts.master')

@section('head_extra')
    <!-- autocomplete ui css -->
    @include('partials.head_css.autocomplete_css')
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
                            <?php endif; $x++; ?>
                        </div>
                        @endforeach <?php $x = 0; ?>
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
        <div class="col-md-12" id="create-purchase-order">
            {!! Form::open( ['route' => 'admin.purchase-orders.store'] ) !!}
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Collapsible Accordion</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center">
                                    <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                </th>
                                <th>{{ trans('admin/formulas/general.columns.materials') }}</th>
                                <th>{{ trans('admin/formulas/general.columns.total') }}</th>
                                <th>{{ trans('admin/formulas/general.columns.stock') }}</th>
                                <th>{{ trans('admin/formulas/general.columns.need') }}</th>
                                <th>{{ trans('admin/formulas/general.columns.quantity') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($total as $material => $value)
                            <tr>
                                <td align="center">
                                    {!! Form::checkbox('material['. $x .'][material_id]', Helpers::getMaterialById($material)->id, false, ['class' => 'material', 'id' => 'material'. $x .'']) !!}
                                </td>
                                <td>{{ Helpers::getMaterialById($material)->name }}</td>
                                <td>{{ $value }}</td>
                                <td>{{ Helpers::getMaterialById($material)->stock }}</td>
                                <td>{{ Helpers::getMaterialById($material)->stock - $value }}</td>
                                <td>
                                    {!! Form::text('material['. $x .'][quantity]', null, ['class' => 'form-control quantity', 'id' => 'quantity'. $x .'', 'disabled']); !!}
                                    {!! Form::hidden('price', Helpers::getMaterialById($material)->price, ['id' => 'price'. $x .'']) !!}
                                    {!! Form::hidden('material['. $x .'][total]', null, ['id' => 'total'. $x .'', 'disabled']) !!}
                                </td>
                            </tr>
                            <?php $x++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/purchase-orders/general.page.create.section-title') }}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::hidden('supplier_id', null, ['id' => 'supplier_id']) !!}
                        {!! Form::label('supplier', trans('admin/purchase-orders/general.columns.supplier')) !!}
                        {!! Form::text('supplier', null, ['class' => 'form-control', 'id' => 'supplier_name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', trans('admin/purchase-orders/general.columns.description')) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('body_bottom')

    <!-- autocomplete UI -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('material[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }

        $('.material').change(function(){
            var currentId = $(this).attr('id').replace('material', '');
            $('#total' + currentId).prop('disabled', function(i, v) { return !v; });
            $('#quantity' + currentId).prop('disabled', function(i, v) { return !v; });
        });

        $('.quantity').focusout(function () {
            var currentId = $(this).attr('id').replace('quantity', '');
            var total = $('#price' + currentId).val() * $('#quantity' + currentId).val();
            $('#total' + currentId).val(total);
        });

        $(document).ready(function () {
            $('#supplier_name').autocomplete({
                source   : '/admin/suppliers/search',
                minLength: 3,
                autoFocus: true,
                select:function(e, ui){
                    // asigning input column from the data that we got above
                    $('#supplier_id').val(ui.item.id);
                }
            });
        });
    </script>
@endsection