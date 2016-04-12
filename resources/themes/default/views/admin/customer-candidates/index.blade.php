@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/customer-candidates/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.customer-candidates.create') !!}" title="{{ trans('admin/customer-candidates/general.button.create') }}">
                        <i class="fa fa-plus-square"></i>
                    </a>

                    <div class="box-tools pull-right">
                        <label class="label label-info"></label>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        @foreach($data as $years => $year)
                            <h5>{{ $years }}</h5>
                            @foreach($year as $months => $month)
                                <div class="panel box box-default">
                                    <div class="box-header">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $months }}-{{ $years }}" aria-expanded="false" class="collapsed">
                                                {{ date("F", mktime(0, 0, 0, $months, 10)) }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="collapse{{ $months }}-{{ $years }}" aria-expanded="false">
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
                                                            <th>{{ trans('admin/customer-candidates/general.columns.name') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.type') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.email') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.phone') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.address') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.status') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align: center">
                                                                <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                                                      <i class="fa fa-check-square-o"></i>
                                                                </a>
                                                            </th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.name') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.type') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.email') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.phone') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.address') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.status') }}</th>
                                                            <th>{{ trans('admin/customer-candidates/general.columns.actions') }}</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        @foreach($month as $m)
                                                            <tr>
                                                                <td align="center">
                                                                    {!! Form::checkbox('chkUser[]', $m->id); !!}
                                                                </td>
                                                                <td>{!! link_to_route('admin.customer-candidates.show', $m->name, $m->id) !!}</td>
                                                                <td>{{ Helpers::getCustomerTypeDisplayName($m->type) }}</td>
                                                                <td>{{ $m->email }}</td>
                                                                <td>{{ $m->phone }}</td>
                                                                <td>{{ $m->address }}</td>
                                                                <td>
                                                                    <a href="{!! route('admin.customer-candidates.update-status', $m->id) !!}" title="{{ trans('general.button.status') }}"><span class="label label-{{ $m->status == 1 ? 'success' : 'danger' }}">{{ Helpers::getCustomerStatusDisplayName($m->status) }}</span>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="{!! route('admin.customer-candidates.confirm-delete', $m->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkUser[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>
@endsection
