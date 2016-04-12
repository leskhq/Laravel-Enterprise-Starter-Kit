@extends('layouts.master')

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
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                <th style="text-align: center">
                                    <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                </th>
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
                                <th style="text-align: center">
                                    <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                </th>
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
                                <td align="center">{!! Form::checkbox('chkPerm[]', $s->id); !!}</td>
                                <td>{!! link_to_route('admin.suppliers.edit', $s->name, $s->id) !!}</td>
                                <td>{{ $s->getCategoryDisplayName($s->category) }}</td>
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
                      {!! $suppliers->render() !!}
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection

@section('body_bottom')
    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkPerm[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>
@endsection
