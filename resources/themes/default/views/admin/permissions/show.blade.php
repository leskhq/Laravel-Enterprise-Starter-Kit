@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model($perm, ['route' => 'admin.permissions.index', 'method' => 'GET']) !!}

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
                        <li class=""><a href="#tab_options" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.options') !!}</a></li>
                        <li class=""><a href="#tab_routes" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.routes') !!}</a></li>
                        <li class=""><a href="#tab_roles" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.roles') !!}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_details">
                            <div class="form-group">
                                {!! Form::label('name', trans('admin/permissions/general.columns.name')) !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('display_name', trans('admin/permissions/general.columns.display_name')) !!}
                                {!! Form::text('display_name', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', trans('admin/permissions/general.columns.description')) !!}
                                {!! Form::text('description', null, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_options">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('enabled', '1', $perm->enabled, ['disabled']) !!} {!! trans('general.status.enabled') !!}
                                    </label>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_routes">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-append">
                                    {!! Form::select('route_search', [], null, ['class' => 'form-control', 'id' => 'route_search', 'disabled' => 'disabled',  'style' => "width: 100%"]) !!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" disabled>
                                            <span class="fa fa-plus-square"></span>
                                        </button>
                                    </span>
                                </div>

                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <th>{!! trans('admin/routes/general.columns.method')  !!}</th>
                                            <th>{!! trans('admin/routes/general.columns.path')  !!}</th>
                                            <th>{!! trans('admin/routes/general.columns.enabled')  !!}</th>
                                            <th style="text-align: right">{!! trans('admin/routes/general.columns.actions')  !!}</th>
                                        </tr>
                                        @foreach($perm->routes as $route)
                                            <tr>
                                                <td>{!! link_to_route('admin.routes.show', $route->method, [$route->id], []) !!}</td>
                                                <td>{!! link_to_route('admin.routes.show', $route->path, [$route->id], []) !!}</td>
                                                <td>
                                                    @if($route->enabled)
                                                        <i class="fa fa-check text-green"></i>
                                                    @else
                                                        <i class="fa fa-close text-red"></i>
                                                    @endif
                                                </td>
                                                <td style="text-align: right">
                                                    <i class="fa fa-trash-o text-muted"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.form-group -->
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_roles">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-append">
                                    {!! Form::select('role_search', [], null, ['class' => 'form-control', 'id' => 'role_search', 'disabled' => 'disabled',  'style' => "width: 100%"]) !!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" disabled>
                                            <span class="fa fa-plus-square"></span>
                                        </button>
                                    </span>
                                </div>

                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <th>{!! trans('admin/roles/general.columns.name')  !!}</th>
                                            <th>{!! trans('admin/roles/general.columns.description')  !!}</th>
                                            <th>{!! trans('admin/roles/general.columns.enabled')  !!}</th>
                                            <th style="text-align: right">{!! trans('admin/roles/general.columns.actions')  !!}</th>
                                        </tr>
                                        @foreach($perm->roles as $role)
                                            <tr>
                                                <td>{!! link_to_route('admin.roles.show', $role->name, [$role->id], []) !!}</td>
                                                <td>{!! link_to_route('admin.roles.show', $role->description, [$role->id], []) !!}</td>
                                                <td>
                                                    @if($role->enabled)
                                                        <i class="fa fa-check text-green"></i>
                                                    @else
                                                        <i class="fa fa-close text-red"></i>
                                                    @endif
                                                </td>
                                                <td style="text-align: right">
                                                    <i class="fa fa-trash-o text-muted"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.form-group -->
                        </div><!-- /.tab-pane -->

                    </div><!-- /.tab-content -->
                </div> <!-- row -->

                <div class="form-group">
                    {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('admin.permissions.edit', $perm->id) !!}" title="{{ trans('general.button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
    <!-- Select2 4.0.0 -->
    <script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

    <!-- Select2 js -->
    @include('partials._body_bottom_select2_js_route_search')
    @include('partials._body_bottom_select2_js_role_search')
@endsection
