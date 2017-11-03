@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model($error, ['route' => 'admin.errors.index', 'method' => 'GET']) !!}

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_details">
                            <div class="form-group">
                                {!! Form::label('date', trans('admin/errors/general.columns.date')) !!}
                                {!! Form::text('date', App\Libraries\Utils::userTimeZone($error->created_at), ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user', trans('admin/errors/general.columns.user')) !!}
                                {!! Form::text('user', ($error->user)? $error->user->username : "N/A", ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('class', trans('admin/errors/general.columns.class')) !!}
                                {!! Form::text('class', $error->class, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('message', trans('admin/errors/general.columns.message')) !!}
                                {!! Form::text('message', $error->message, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('ip', trans('admin/errors/general.columns.ip')) !!}
                                {!! Form::text('ip', $error->ip, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('method', trans('admin/errors/general.columns.method')) !!}
                                {!! Form::text('method', $error->method, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('url', trans('admin/errors/general.columns.url')) !!}
                                {!! Form::text('url', $error->url, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('data', trans('admin/errors/general.columns.data')) !!}
                                <pre readonly="readonly">{{$error->flatdata}}</pre>
                            </div>
                            <div class="form-group">
                                {!! Form::label('file', trans('admin/errors/general.columns.file')) !!}
                                {!! Form::text('file', $error->file, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('code', trans('admin/errors/general.columns.code')) !!}
                                {!! Form::text('code', $error->code, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status_code', trans('admin/errors/general.columns.status_code')) !!}
                                {!! Form::text('status_code', $error->status_code, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('line', trans('admin/errors/general.columns.line')) !!}
                                {!! Form::text('line', $error->line, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('trace', trans('admin/errors/general.columns.trace')) !!}
                                <pre readonly="readonly">{{$error->trace}}</pre>
                            </div>
                        </div><!-- /.tab-pane -->

                    </div><!-- /.tab-content -->
                </div> <!-- row -->

                <div class="form-group">
                    {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
@endsection
