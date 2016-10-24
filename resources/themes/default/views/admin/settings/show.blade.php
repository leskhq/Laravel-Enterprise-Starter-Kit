@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model($key, ['route' => 'admin.settings.index', 'method' => 'GET']) !!}

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_details">
                            <div class="form-group">
                                {!! Form::label('key', trans('admin/settings/general.columns.name')) !!}
                                {!! Form::text('key', $key, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('value', trans('admin/settings/general.columns.value')) !!}
                                {!! Form::text('value', $value, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('encrypted', '1', Setting::isEncrypted($key), ['disabled']) !!} {!! trans('admin/settings/general.columns.encrypted') !!}
                                    </label>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                    </div><!-- /.tab-content -->
                </div> <!-- row -->

                <div class="form-group">
                    {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('admin.settings.edit', $key) !!}" title="{{ trans('general.button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
@endsection
