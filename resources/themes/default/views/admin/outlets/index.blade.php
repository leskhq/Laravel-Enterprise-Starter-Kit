@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/outlets/general.page.index.table-title') }}</h3>
                    &nbsp;
                    @if(Auth::user()->username != 'indry')
                    <a class="btn btn-default btn-sm" href="{!! route('admin.outlets.create') !!}" title="{{ trans('admin/outlets/general.action.create') }}">
                      <i class="fa fa-plus-square"></i>
                    </a>
                    @endif
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin/outlets/general.columns.name') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.email') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.phone') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.address') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('admin/outlets/general.columns.name') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.email') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.phone') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.address') }}</th>
                                    <th>{{ trans('admin/outlets/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($outlets as $outlet)
                                <tr>
                                    <td>{!! link_to_route('admin.outlets.show', $outlet->name, $outlet->id) !!}</td>
                                    <td>{{ $outlet->email }}</td>
                                    <td>{{ $outlet->phone }}</td>
                                    <td>{{ $outlet->address }}</td>
                                    <td>
                                        <a href="{!! route('admin.outlets.confirm-delete', $outlet->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
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
