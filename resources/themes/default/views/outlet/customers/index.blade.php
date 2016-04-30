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
                    <h3 class="box-title">{{ trans('outlet/customers/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a href="{{ route('outlet.customers.create') }}" class="btn btn-default btn-sm" title="{{ trans('outlet/customers/general.button.create') }}"><i class="fa fa-plus-square"></i></a>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('outlet/customers/general.columns.name') }}</th>
                                    <th>{{ trans('outlet/customers/general.columns.email') }}</th>
                                    <th>{{ trans('outlet/customers/general.columns.phone') }}</th>
                                    <th>{{ trans('outlet/customers/general.columns.address') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('outlet/customers/general.columns.name') }}</th>
                                    <th>{{ trans('outlet/customers/general.columns.email') }}</th>
                                    <th>{{ trans('outlet/customers/general.columns.phone') }}</th>
                                    <th>{{ trans('outlet/customers/general.columns.address') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($customers as $key => $customer)
                                <tr>
                                    <td>{!! link_to_route('outlet.customers.show', $customer->name, $customer->id) !!}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
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
                "order": [[ 2, 'desc' ]],
                "ordering": false
            });
        });
    </script>
@endsection
