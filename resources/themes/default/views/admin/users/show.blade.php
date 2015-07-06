@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/users/general.page.show.section-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model($user, ['route' => 'admin.users.index', 'method' => 'GET']) !!}

                    <div class="form-group">
                        {!! Form::label('first_name', trans('admin/users/general.columns.first_name')) !!}
                        {!! Form::text('first_name', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('last_name', trans('admin/users/general.columns.last_name')) !!}
                        {!! Form::text('last_name', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('username', trans('admin/users/general.columns.username')) !!}
                        {!! Form::text('username', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', trans('admin/users/general.columns.email')) !!}
                        {!! Form::text('email', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', trans('admin/users/general.columns.password')) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation', trans('admin/users/general.columns.password_confirmation')) !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {{ trans('admin/users/general.columns.roles') }}
                        @foreach($roles as $role)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('role[]', $role->id, $user->hasRole($role->name), ['disabled']) !!} {{ $role->display_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                        @if ($user->isEditable())
                            <a href="{!! route('admin.users.edit', $user->id) !!}" title="{{ trans('general.button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                        @endif
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection
