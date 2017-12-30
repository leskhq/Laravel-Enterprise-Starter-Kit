@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">

                            <div class="col-sm-6">
                                <h3 class="box-title">{{ trans('admin/modules/general.page.index.table-title') }}</h3>

                                @permission('core.p.modules.optimize')
                                    <a class="btn btn-default btn-sm" href="{!! route('admin.modules.optimize') !!}" title="{{ trans('admin/modules/general.button.optimize') }}">
                                        <i class="fa fa-fighter-jet"></i>
                                    </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/users/general.error.no-permission-to-optimize-modules') }}">
                                        <i class="fa fa-fighter-jet"></i>
                                    </a>
                                @endpermission

                            </div> <!-- col-sm-6 -->

                        </div> <!-- row -->
                    </div>
                    <div class="box-body">
                        {!! $grid !!}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection

@section('body_bottom')
@endsection
