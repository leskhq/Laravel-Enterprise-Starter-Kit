@extends('layouts.master')

@section('head_extra')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open( array('route' => 'admin.materials.order-selected', 'id' => 'frmMaterialList') ) !!}
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('admin/materials/general.page.index.title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{{ route('admin.materials.create') }}" title="{{ trans('general.button.create') }}">
                        <i class="fa fa-plus-square"></i>
                    </a>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="#" onclick="document.forms['frmMaterialList'].action = '{!! route('admin.materials.order-selected') !!}';  document.forms['frmMaterialList'].submit(); return false;" title="{{ trans('general.button.create') }}" disabled>
                        <i class="fa fa-times"></i>
                    </a>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>
                                    </th>
                                    <th>{{ trans('admin/materials/general.columns.name') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.price') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.stock') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.min_stock') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>
                                        <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>
                                    </th>
                                    <th>{{ trans('admin/materials/general.columns.name') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.price') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.stock') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.min_stock') }}</th>
                                    <th>{{ trans('admin/materials/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($materials as $material)
                                <tr>
                                    <td align="center">
                                        {!! Form::checkbox('chkMaterial[]', $material->id); !!}
                                    </td>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->price }}</td>
                                    <td>{{ $material->stock }}</td>
                                    <td>{{ $material->min_stock }}</td>
                                    <td>
                                        <a href="{!! route('admin.materials.edit', $material->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{!! route('admin.materials.confirm-delete', $material->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('body_bottom')
    @include('partials.body_bottom_js.datatable_js')

    <script type="text/javascript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkMaterial[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
        $(document).ready(function() {
            $('#example2').DataTable({
                'order': [[1, 'asc']]
            });
        });
    </script>
@endsection