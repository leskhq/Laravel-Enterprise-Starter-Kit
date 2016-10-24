@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.settings.show', 'id' => 'frmSettingList') ) !!}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin/settings/general.page.index.table-title') }}</h3>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="{!! route('admin.settings.create') !!}" title="{{ trans('admin/settings/general.action.create') }}">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="{!! route('admin.settings.load') !!}" title="{{ trans('admin/settings/general.action.load') }}">
                            <i class="fa fa-refresh"></i>
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
                                        <th>{{ trans('admin/settings/general.columns.name') }}</th>
                                        <th>{{ trans('admin/settings/general.columns.value') }}</th>
                                        <th>{{ trans('admin/settings/general.columns.actions') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>{{ trans('admin/settings/general.columns.name') }}</th>
                                        <th>{{ trans('admin/settings/general.columns.value') }}</th>
                                        <th>{{ trans('admin/settings/general.columns.actions') }}</th>
                                    </tr>
                                </tfoot>



                                <tbody>
                                    @foreach($settingsFiltered as $key => $value)
                                        <tr>
                                            <td>{!! link_to_route('admin.settings.show', $key, [$key], []) !!}</td>
                                            <td>{!! link_to_route('admin.settings.show', \App\Libraries\Str::head($value, 70, "..."), [$key], []) !!}</td>
                                            <td>
                                                <a href="{!! route('admin.settings.edit', $key) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{!! route('admin.settings.confirm-delete', $key) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
@endsection
