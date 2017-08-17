<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_profile" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.profile') !!}</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="tab_profile">
            <div class="form-group">
                {!! Form::label('first_name', trans('admin/users/general.columns.first_name')) !!}
                @if ( $user->isRoot() )
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'readonly']) !!}
                @else
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('last_name', trans('admin/users/general.columns.last_name')) !!}
                @if ( $user->isRoot() )
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'readonly']) !!}
                @else
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('username', trans('admin/users/general.columns.username')) !!}
                @if ( $user->isRoot() )
                    {!! Form::text('username', null, ['class' => 'form-control', 'readonly']) !!}
                @else
                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('email', trans('admin/users/general.columns.email')) !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', trans('admin/users/general.columns.password')) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', trans('admin/users/general.columns.password_confirmation')) !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('auth_type', trans('admin/users/general.columns.type')) !!}
                {!! Form::text('auth_type', null, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div>
