@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.modules.enable-selected', 'id' => 'frmModuleList') ) !!}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin/modules/general.page.index.table-title') }}</h3>
                        &nbsp;
                        <a class="btn btn-default btn-sm" href="{!! route('admin.modules.optimize') !!}" title="{{ trans('admin/modules/general.button.optimize') }}">
                            <i class="fa fa-fighter-jet"></i>
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
                                        <th>{{ trans('admin/modules/general.columns.name') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.description') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.order') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.actions') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>{{ trans('admin/modules/general.columns.name') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.description') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.order') }}</th>
                                        <th>{{ trans('admin/modules/general.columns.actions') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($modules as $mod)
                                        <tr>
                                            <td>{{ $mod['name'] }}</td>
                                            <td>{{ $mod['description'] }}</td>
                                            <td>{{ $mod['order'] }}</td>
                                            <td>
                                                @if ( Module::isInitialized($mod['slug']) )
                                                    @if ( Module::isEnabled($mod['slug']) )
                                                        <i class="fa fa-thumbs-up text-muted" title="{{ trans('admin/modules/general.error.cant-uninitialize-this-module') }}"></i>
                                                    @else
                                                        <a href="{!! route('admin.modules.confirm-uninitialize', $mod['slug']) !!}" data-toggle="modal" data-target="#modal_dialog_danger" title="{{ trans('admin/modules/general.button.uninitialize') }}"><i class="fa fa-thumbs-up enabled"></i></a>
                                                    @endif
                                                @else
                                                    <a href="{!! route('admin.modules.initialize', $mod['slug']) !!}" title="{{ trans('admin/modules/general.button.initialize') }}"><i class="fa fa-thumbs-down disabled"></i></a>
                                                @endif


                                                @if ( Module::isEnabled($mod['slug']) )
                                                    <a href="{!! route('admin.modules.disable', $mod['slug']) !!}" title="{{ trans('general.button.disable') }}"><i class="fa fa-check-circle-o enabled"></i></a>
                                                @else
                                                        @if ( Module::isInitialized($mod['slug']) )
                                                            <a href="{!! route('admin.modules.enable', $mod['slug']) !!}" title="{{ trans('general.button.enable') }}"><i class="fa fa-ban disabled"></i></a>
                                                        @else
                                                            <i class="fa fa-ban text-muted" title="{{ trans('admin/modules/general.error.cant-enable-this-module') }}"></i>
                                                        @endif
                                                @endif
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
