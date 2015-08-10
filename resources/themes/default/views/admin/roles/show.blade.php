@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/roles/general.page.show.section-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model($role, ['route' => 'admin.roles.index', 'method' => 'GET']) !!}

                    <div class="form-group">
                        {!! Form::label('name', trans('admin/roles/general.columns.name')) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('display_name', trans('admin/roles/general.columns.display_name')) !!}
                        {!! Form::text('display_name', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', trans('admin/roles/general.columns.description')) !!}
                        {!! Form::text('description', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('options', trans('admin/roles/general.columns.options')) !!}
                        <div class="checkbox" id="options" name="options">
                            <label>
                                {!! Form::checkbox('resync_on_login', '1', $role->resync_on_login, ['disabled']) !!} {{ trans('admin/roles/general.columns.resync_on_login') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('perms[]', trans('admin/roles/general.columns.permissions')) !!}
                        @foreach($perms as $perm)
                            <?php $checked = (isset($rolePerms))?in_array($perm->id, $rolePerms->lists('id')->toArray()) : false; ?>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('perms[]', $perm->id, $role->hasPerm($perm), ['disabled']) !!} {{ $perm->display_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        {!! Form::submit(trans('general.button.close'), ['class' => 'btn btn-primary']) !!}
                        @if ( $role->isEditable() || $role->canChangePermissions() )
                            <a href="{!! route('admin.roles.edit', $role->id) !!}" title="{{ trans('general..button.edit') }}" class='btn btn-default'>{{ trans('general.button.edit') }}</a>
                        @endif
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection
