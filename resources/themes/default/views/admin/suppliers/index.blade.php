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
                  <h3 class="box-title">{{ trans('admin/suppliers/general.page.index.table-title') }}</h3>
                  &nbsp;
                  <a class="btn btn-default btn-sm" href="{!! route('admin.suppliers.create') !!}" title="{{ trans('admin/suppliers/general.action.create') }}">
                    <i class="fa fa-plus-square"></i>
                  </a>

                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
              </div>
              <div class="box-body">
                  <div class="table-responsive">
                      <table id="example2" class="table table-hover table-striped">
                          <thead>
                              <tr>
                                <!-- <th style="text-align: center">
                                    <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                </th> -->
                                <th>{{ trans('admin/suppliers/general.columns.name') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.category') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.contact') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.address') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.description') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.actions') }}</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <!-- <th style="text-align: center">
                                    <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                </th> -->
                                <th>{{ trans('admin/suppliers/general.columns.name') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.category') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.contact') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.address') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.description') }}</th>
                                <th>{{ trans('admin/suppliers/general.columns.actions') }}</th>
                              </tr>
                          </tfoot>
                          <tbody>
                            @foreach($suppliers as $s)
                              <tr>
                                <!-- <td align="center">{!! Form::checkbox('chkPerm[]', $s->id); !!}</td> -->
                                <td>{!! link_to_route('admin.suppliers.edit', $s->name, $s->id) !!}</td>
                                <td>{{ $s->getCategoryDisplayName() }}</td>
                                <td>{{ $s->contact }}</td>
                                <td>{{ $s->address }}</td>
                                <td>{{ $s->description }}</td>
                                <td>
                                    <a href="{!! route('admin.suppliers.confirm-delete', $s->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
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
