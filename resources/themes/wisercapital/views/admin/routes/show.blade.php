@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/routes/general.page.show.section-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model($route, ['route' => 'admin.routes.index', 'method' => 'GET']) !!}

                    <div class="form-group">
                        {!! Form::label('method', trans('admin/routes/general.columns.method')) !!}
                        {!! Form::text('method', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('path', trans('admin/routes/general.columns.path')) !!}
                        {!! Form::text('path', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', trans('admin/routes/general.columns.name')) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('action_name', trans('admin/routes/general.columns.action_name')) !!}
                        {!! Form::text('action_name', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('admin.routes.edit', $route->id) !!}" title="{{ trans('general.button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection
