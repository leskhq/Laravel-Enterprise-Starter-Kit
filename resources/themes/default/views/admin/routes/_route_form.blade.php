<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_profile" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.profile') !!}</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="tab_profile">
            <div class="form-group">
                {!! Form::label('name', trans('admin/routes/general.columns.name')) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('method', trans('admin/routes/general.columns.method')) !!}
                {!! Form::text('method', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('path', trans('admin/routes/general.columns.path')) !!}
                {!! Form::text('path', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('action_name', trans('admin/routes/general.columns.action_name')) !!}
                {!! Form::text('action_name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('permission', trans('admin/routes/general.columns.permission')) !!}
                {!! Form::text('permission', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('enabled', trans('admin/routes/general.columns.enabled')) !!}
                {!! Form::text('enabled', null, ['class' => 'form-control']) !!}
            </div>

        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div>
