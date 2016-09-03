@extends('layouts.master')

@section('head_extra')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/customers/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.customer-candidates.create') !!}" title="{{ trans('admin/customers/general.button.create') }}">
                        <i class="fa fa-plus-square"></i>
                    </a>
		    <a class="btn btn-default btn-sm" href="{!! route('admin.customers.export', $tipe) !!}" title="{{ trans('admin/customers/general.button.export') }}">
                        Export Excel
                    </a>

                    <div class="box-tools pull-right">
                        <label class="label label-info">{{ $customers->count() }}</label>
                        <label class="label label-info"></label>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-hover">
                            <thead>
                                <tr>
                                    <!-- <th style="text-align: center">
                                        <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>
                                    </th> -->
                                    <th>{{ trans('admin/customers/general.columns.name') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.email') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.phone') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.address') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.status') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <!-- <th style="text-align: center">
                                        <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>
                                    </th> -->
                                    <th>{{ trans('admin/customers/general.columns.name') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.email') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.phone') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.address') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.status') }}</th>
                                    <th>{{ trans('admin/customers/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($customers as $key => $c)
                                    <tr>
                                        <!-- <td align="center">
                                            {!! Form::checkbox('chkUser[]', $c->id); !!}
                                        </td> -->
                                        <td>{!! link_to_route('admin.customers.show', $c->name, $c->id) !!}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->phone }}</td>
                                        <td>{{ $c->laundry_address ? $c->laundry_address : $c->address }}</td>
                                        <td>
                                            <a href="{!! route('admin.customers.update-status', $c->id) !!}" title="{{ trans('general.button.status') }}"><span class="label label-{{ $c->status == 1 ? 'success' : 'danger' }}">{{ Helpers::getCustomerStatusDisplayName($c->status) }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{!! route('admin.customers.confirm-delete', $c->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
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

    <script language="JavaScript">
        $('#example2').DataTable({
            "ordering": false
        });
    </script>
@endsection
