@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
    <!-- NProgress 0.2.0  -->
    <link rel="stylesheet" href="{{ asset('/bower_components/nprogress/nprogress.css') }}" media="screen" charset="utf-8">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/sales/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.sales.create') !!}" title="{{ trans('admin/sales/general.action.create') }}">
                      <i class="fa fa-plus-square"></i>
                    </a>
                    &nbsp;
                    {!! Form::select( 'saleStatus', config('constant.sale-status'), '', [ 'style' => 'max-width:150px;', 'id' => 'select-sale-status', 'class' => 'select-sale-status', '_token' => csrf_token()] ) !!}
                    &nbsp;
                    <a class="btn btn-default btn-sm" id="search" href="#" title="{{ trans('admin/sales/general.button.search') }}">
                        Sort by status&nbsp;
                        <i class="fa fa-search"></i>
                    </a>

                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin/sales/general.columns.name') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.order_date') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.transfer_date') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.nominal') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.total') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.status') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('admin/sales/general.columns.name') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.order_date') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.transfer_date') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.nominal') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.total') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.status') }}</th>
                                    <th>{{ trans('admin/sales/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody id="content">
                                @foreach($sales as $key => $sale)
                                <tr>
                                    <td>{!! link_to_route('admin.sales.show', $sale->customer->name, $sale->id) !!}</td>
                                    <td>{{ Helpers::date($sale->order_date) }}</td>
                                    <td>{{ Helpers::date($sale->transfer_date) }}</td>
                                    <td>{{ Helpers::reggo($sale->nominal) }}</td>
                                    <td>{{ Helpers::reggo($sale->nominal+$sale->shipping_fee+$sale->packing_fee) }}</td>
                                    <td>
                                        {!! Form::select('status', config('constant.sale-status'), $sale->status, ['class' => 'form-control status',  'data-id' => $sale->id, 'data-token' => csrf_token()]) !!}
                                    </td>
                                    <td>
                                        <a href="{!! route('admin.sales.edit', $sale->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{!! route('admin.sales.print', $sale->id) !!}" target="_blank" title="{{ trans('general.button.print') }}"><i class="fa fa-print"></i></a>
                                        <a href="{!! route('admin.sales.confirm-delete', $sale->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
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
    <!-- Select2 4.0.0 -->
    <script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

    <!-- NProgress 0.2.0  -->
    <script src="{{ asset('/bower_components/nprogress/nprogress.js') }}" type="text/javascript"></script>

    <!-- DataTables -->
    <script src="{{ asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script language="JavaScript">
        function status() {
            $('.status').change(function(e) {
                NProgress.start();
                var status = $(this).val();
                var id     = $(this).data('id');
                var data   = {
                        _token: $(this).data('token'),
                        status: status
                    }

                $.ajax({
                    url : "/admin/sales/" + id + "/update-status",
                    data: data,
                    type : 'POST',
                    dataType : 'html',
                    success: function(data){
                        NProgress.done();
                    }
                });
                e.stopPropagation();
            });
        }
        $(document).ready(function() {
            $('#example2').DataTable({
                "order": [[ 2, 'desc' ]],
                "ordering": false
            });

            status();

            $(".select-sale-status").select2();

            $('#search').click(function(event) {
                event.preventDefault();
                NProgress.start();
                var query = $(".select-sale-status").val();
                var token = $(".select-sale-status").attr('_token');

                $.ajax({
                    url : "sales/select-by-status",
                    data: ({query : query, _token : token}),
                    type : 'POST',
                    dataType : 'html',
                    success: function(data){
                        $( "#content" ).empty();
                        $( "#content" ).append( data );
                        NProgress.done();
                        status();
                    }
                });
            });
        });
    </script>
@endsection
