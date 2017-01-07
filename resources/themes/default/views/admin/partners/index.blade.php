@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Mitra</h3>
                &nbsp;
                <a class="btn btn-default btn-sm" href="{!! route('admin.partners.create') !!}" title="{{ trans('admin/sales/general.action.create') }}">
                  <i class="fa fa-plus-square"></i>
                </a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telpon</th>
                                <th>Tanggal Aktif</th>
                                <th>{{ trans('admin/sales/general.columns.actions') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telpon</th>
                                <th>Tanggal Aktif</th>
                                <th>{{ trans('admin/sales/general.columns.actions') }}</th>
                            </tr>
                        </tfoot>
                        <tbody id="content">
                            @foreach($partners as $key => $sale)
                            <tr>
                                <td>{!! link_to_route('admin.partners.show', $sale->name, $sale->id) !!}</td>
                                <td>{{ $sale->email }}</td>
                                <td>{{ $sale->phone }}</td>
                                <td>{{ $sale->active_date }}</td>
                                <td>
                                    <a href="#" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
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

    <!-- Datatable -->
    @include('partials.body_bottom_js.datatable_js')
@endsection
