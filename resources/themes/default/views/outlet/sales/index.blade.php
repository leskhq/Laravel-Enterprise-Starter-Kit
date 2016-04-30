@extends('layouts.master')

@section('head_extra')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    &nbsp;
                    <a href="" class="btn btn-default btn-sm" title=""><i class="fa fa-plus-square"></i></a>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('outlet/sales/general.columns.created') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.kilo_quantity') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.piece_quantity') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.kilo_total') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.piece_total') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('outlet/sales/general.columns.created') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.kilo_quantity') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.piece_quantity') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.kilo_total') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.piece_total') }}</th>
                                    <th>{{ trans('outlet/sales/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($sales as $key => $sale)
                                <tr>
                                    <td>{{ $sale->created_at }}</td>
                                    <td>{{ $sale->kilo_quantity }}</td>
                                    <td>{{ $sale->piece_quantity }}</td>
                                    <td>{{ $sale->kilo_total }}</td>
                                    <td>{{ $sale->piece_total }}</td>
                                    <td>
                                        <a href="{!! route('outlet.sales.confirm-delete', $sale->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
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
    <!-- DataTables -->
    <script src="{{ asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example2').DataTable({
                "order": [[ 0, 'desc' ]],
                "ordering": false
            });
        });
    </script>
@endsection
