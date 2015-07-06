@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/permissions/general.page.show.section-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model($perm, ['route' => 'admin.permissions.index', 'method' => 'GET']) !!}

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

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h4>{{ trans('admin/permissions/general.columns.routes') }}</h4>
                                    <table>
                                        <tbody>
                                            @foreach($perm->routes as $route)
                                                <tr>
                                                    <td>{{ $route->method }}</td>
                                                    <td>{{ $route->path }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div> <!-- form-group -->
                        </div> <!-- col-sm-6 -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <h4>{{ trans('admin/permissions/general.columns.roles') }}</h4>
                                <table>
                                    <tbody>
                                        @foreach($perm->roles as $role)
                                            <tr>
                                                <td>{{ $role->display_name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- form-group -->
                        </div> <!-- col-sm-6 -->

                    </div> <!-- row -->

                    <div class="form-group">
                        {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('admin.permissions.edit', $perm->id) !!}" title="{{ trans('general.button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection
