@extends('layouts.master')

@section('head_extra')
    <!-- NProgress 0.2.0  -->
    <link rel="stylesheet" href="{{ asset('/bower_components/nprogress/nprogress.css') }}" media="screen" charset="utf-8">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('admin/purchase-orders/general.columns.status') }}</span>
                    <span class="info-box-number">{{ Helpers::getPurchaseOrderStatusDisplayName($purchaseOrder->status) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('admin/purchase-orders/general.columns.total') }}</span>
                    <span class="info-box-number">{{ Helpers::reggo($purchaseOrder->total) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('admin/purchase-orders/general.columns.created') }}</span>
                    <span class="info-box-number">{{ $purchaseOrder->created_at }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Details</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.accepted') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.material') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.quantity') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.total') }}</th>
                            <th>Supplier</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.description') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.columns.created') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.columns.actions') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.accepted') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.material') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.quantity') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.total') }}</th>
                            <th>Supplier</th>
                            <th>{{ trans('admin/purchase-orders/general.detail.columns.description') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.columns.created') }}</th>
                            <th>{{ trans('admin/purchase-orders/general.columns.actions') }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($purchaseOrder->purchaseOrderDetails as $key => $detail)
                        <tr>
                            <td style="text-align: center">
                                {!! Form::checkbox('accepted', $detail->status, $detail->accepted, ['class' => 'status', 'id' => $detail->id]) !!}
                            </td>
                            <td>{{ $detail->material->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ Helpers::reggo($detail->total) }}</td>
                            <td>{{ $detail->supplier->name }}</td>
                            <td>{{ $detail->description }}</td>
                            <td>{{ $detail->created_at }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <a href="{{ route('admin.purchase-orders.edit', $purchaseOrder->id) }}" class="btn btn-default"><i class="fa fa-edit"></i> {{ trans('general.button.edit') }}</a>
            <a href="{{ route('admin.purchase-orders.print', $purchaseOrder->id) }}" target="_blank" class="btn btn-default"><i class="fa fa-edit"></i> Print</a>
            <div class="pull-right">
                <a href="{{ route('admin.purchase-orders.check-all', $purchaseOrder->id) }}" class="btn btn-default"><i class="fa fa-check"></i> {{ trans('general.button.check-all') }}</a>
                <a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-default"><i class="fa fa-times"></i> {{ trans('general.button.close') }}</a>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <!-- bootstrap notify -->
    <script type="text/javascript" src="{{ asset("/bower_components/bootstrap-notify-3.1.3/bootstrap-notify.js") }}"></script>

    <!-- NProgress 0.2.0  -->
    <script src="{{ asset('/bower_components/nprogress/nprogress.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.status').change(function() {
                NProgress.start();
                var id = $(this).attr('id');
                var token =
                $.ajax({
                    url      : "/admin/purchase-orders/" + id + "/update-status",
                    data     : {'_token': $('meta[name="csrf-token"]').attr('content')},
                    type     : 'POST',
                    dataType : 'html',
                    success: function(data){
                        NProgress.done();
                        $.notify({
                            title: "Success:",
                            message: "Accepted status has been changed."
                        });
                    }
                });
            });
        });
    </script>
@endsection