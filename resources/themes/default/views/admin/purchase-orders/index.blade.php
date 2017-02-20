@extends('layouts.master')

@section('head_extra')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $materials->count() }}</h3>

                    <p>Material(s) at Min Stock</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('admin.materials.out-of-stock') }}" class="small-box-footer">See All <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $pending->count() }}</h3>

                    <p>Pending Purchase Order(s)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('admin/purchase-orders/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a href="{!! route('admin.purchase-orders.create') !!}" class="btn btn-default btn-sm" title="{{ trans('general.button.create') }}"><i class="fa fa-plus-square"></i></a>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin/purchase-orders/general.columns.created') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.status') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.total') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.description') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('admin/purchase-orders/general.columns.created') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.status') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.total') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.description') }}</th>
                                    <th>{{ trans('admin/purchase-orders/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($purchaseOrders as $key => $pO)
                                <tr>
                                    <td>{!! link_to_route('admin.purchase-orders.show', $pO->created_at, $pO->id) !!}</td>
                                    <td>{{ Helpers::getPurchaseOrderStatusDisplayName($pO->status) }}</td>
                                    <td>{{ Helpers::reggo($pO->total) }}</td>
                                    <td>{{ $pO->description }}</td>
                                    <td>
                                        <a href="{!! route('admin.purchase-orders.confirm-delete', $pO->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <!-- Datatable -->
    @include('partials.body_bottom_js.datatable_js')

    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection