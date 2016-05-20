@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/routes/general.page.edit.section-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model( $route, ['route' => ['admin.routes.update', $route->id], 'method' => 'PATCH'] ) !!}

                    @include('partials._route_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.update'), ['class' => 'btn btn-primary'] ) !!}
                        <a href="{!! route('admin.routes.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection
