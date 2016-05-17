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
                    <h3 class="box-title">{{ trans('admin/formulas/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a href="{{ route('admin.formulas.create') }}" class="btn btn-default btn-sm" title=""><i class="fa fa-plus-square"></i></a>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin/formulas/general.columns.product_id') }}</th>
                                    <th>{{ trans('admin/formulas/general.columns.created') }}</th>
                                    <th>{{ trans('admin/formulas/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('admin/formulas/general.columns.product_id') }}</th>
                                    <th>{{ trans('admin/formulas/general.columns.created') }}</th>
                                    <th>{{ trans('admin/formulas/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($formulas as $f)
                                <tr>
                                    <td>{!! link_to_route('admin.formulas.show', $f->product->name, $f->id) !!}</td>
                                    <td>{{ $f->created_at }}</td>
                                    <td>
                                        <a href="{!! route('admin.formulas.edit', $f->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{!! route('admin.formulas.confirm-delete', $f->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
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
                "order": [[ 0, 'asc' ]],
                "ordering": false
            });
        });
    </script>
@endsection