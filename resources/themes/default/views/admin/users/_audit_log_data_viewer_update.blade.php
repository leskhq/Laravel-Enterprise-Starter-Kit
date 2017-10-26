
    @if ( $dataArray )
        <div class="form-group">
            {!! Form::label('first_name', trans('admin/users/general.columns.first_name')) !!}
            {!! Form::text('first_name', $dataArray['first_name'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('last_name', trans('admin/users/general.columns.last_name')) !!}
            {!! Form::text('last_name', $dataArray['last_name'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('username', trans('admin/users/general.columns.username')) !!}
            {!! Form::text('username', $dataArray['username'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', trans('admin/users/general.columns.email')) !!}
            {!! Form::text('email', $dataArray['email'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('auth_type', trans('admin/users/general.columns.auth_type')) !!}
            {!! Form::text('auth_type', $dataArray['auth_type'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('enabled', trans('admin/users/general.columns.enabled')) !!}
            {!! Form::text('enabled', $dataArray['enabled'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('theme', trans('admin/users/general.columns.theme')) !!}
            {!! Form::text('theme', $dataArray['settings']['theme.default'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('timezone', trans('admin/users/general.columns.timezone')) !!}
            {!! Form::text('timezone', $dataArray['settings']['app.timezone'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('time_format', trans('admin/users/general.columns.time_format')) !!}
            {!! Form::text('time_format', $dataArray['settings']['app.time_format'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('locale', trans('admin/users/general.columns.locale')) !!}
            {!! Form::text('locale', $dataArray['settings']['app.locale'], ['class' => 'form-control', 'readonly']) !!}
        </div>
    @else
        <div class="form-group">
            <input class="form-control" readonly="readonly" name="data" type="text" value="{!! trans('admin/audits/general.error.no-data') !!}" id="data">
        </div>
    @endif

