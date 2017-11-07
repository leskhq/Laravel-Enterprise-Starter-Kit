@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model($audit, ['route' => 'admin.audits.index', 'method' => 'GET']) !!}

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
                        <li class=""><a href="#tab_data" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.data') !!}</a></li>
                        <li class=""><a href="#tab_raw" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.raw') !!}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_details">
                            <div class="form-group">
                                {!! Form::label('username', trans('admin/audits/general.columns.username')) !!}
                                {!! Form::text('username', ($audit->user) ? $audit->user->username : "-Unauthenticated user-", ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', trans('admin/audits/general.columns.category')) !!}
                                {!! Form::text('category', $audit->user->category, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('message', trans('admin/audits/general.columns.message')) !!}
                                {!! Form::text('message', $audit->user->message, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('method', trans('admin/audits/general.columns.method')) !!}
                                {!! Form::text('method', $audit->method, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('action', trans('admin/audits/general.columns.route_action')) !!}
                                {!! Form::text('action', $audit->route_action, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('route_name', trans('admin/audits/general.columns.route_name')) !!}
                                {!! Form::text('route_name', $audit->route_name, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_agent', trans('admin/audits/general.columns.user_agent')) !!}
                                {!! Form::text('user_agent', $audit->userAgent, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('ip', trans('admin/audits/general.columns.ip')) !!}
                                {!! Form::text('ip', $audit->ip, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('device', trans('admin/audits/general.columns.device')) !!}
                                {!! Form::text('device', $audit->device, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('platform', trans('admin/audits/general.columns.platform')) !!}
                                {!! Form::text('platform', $audit->platform, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('browser', trans('admin/audits/general.columns.browser')) !!}
                                {!! Form::text('browser', $audit->browser, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_desktop', trans('admin/audits/general.columns.is_desktop')) !!}
                                {!! Form::text('is_desktop', ($audit->isDesktop)?"True":"False", ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_mobile', trans('admin/audits/general.columns.is_mobile')) !!}
                                {!! Form::text('is_mobile', ($audit->isMobile)?"True":"False", ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_phone', trans('admin/audits/general.columns.is_phone')) !!}
                                {!! Form::text('is_phone', ($audit->isPhone)?"True":"False", ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_tablet', trans('admin/audits/general.columns.is_tablet')) !!}
                                {!! Form::text('is_tablet', ($audit->isTablet)?"True":"False", ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('date', trans('admin/audits/general.columns.date')) !!}
                                {!! Form::text('date', App\Libraries\Utils::userTimeZone($audit->created_at), ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_data">
                            <div class="form-group">
                                @if ( $data_view )
                                    {!! $data_view !!}
                                @else
                                    @if ($audit->data)
                                        {!! trans('admin/audits/general.error.no-data-viewer') !!}
                                    @else
                                        {!! trans('admin/audits/general.error.no-data') !!}
                                    @endif
                                @endif
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_raw">
                            <div class="form-group">
                                <pre>
                                    {!! print_r($audit->attributesToArray()) !!}
                                </pre>
                            </div>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div> <!-- row -->

                <div class="form-group">
                    {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                    @if ( $audit->replay_route )
                        <a href="{!! route('admin.audits.replay', $audit->id) !!}" title="{{ trans('general.button.replay') }}" class="btn btn-default">{{ trans('general.button.replay') }}</a>
                    @endif
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
@endsection
