@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model($audit, ['route' => 'admin.audit.index', 'method' => 'GET']) !!}

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
                        <li class=""><a href="#tab_data" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.data') !!}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_details">
                            <div class="form-group">
                                {!! Form::label('username', trans('admin/audit/general.columns.username')) !!}
                                {!! Form::text('username', $audit->user->username, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', trans('admin/audit/general.columns.category')) !!}
                                {!! Form::text('category', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('message', trans('admin/audit/general.columns.message')) !!}
                                {!! Form::text('message', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('date', trans('admin/audit/general.columns.date')) !!}
                                {!! Form::text('date', App\Libraries\Utils::userTimeZone($audit->created_at), ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_data">
                            <div class="form-group">
                                @if ( $data_view )
                                    {!! $data_view !!}
                                @else
                                    @if ($audit->data)
                                        {!! trans('admin/audit/general.error.no-data-viewer') !!}
                                    @else
                                        {!! trans('admin/audit/general.error.no-data') !!}
                                    @endif
                                @endif
                            </div>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div> <!-- row -->

                <div class="form-group">
                    {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                    @if ( $audit->replay_route )
                        <a href="{!! route('admin.audit.replay', $audit->id) !!}" title="{{ trans('general.button.replay') }}" class="btn btn-default">{{ trans('general.button.replay') }}</a>
                    @endif
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
@endsection
