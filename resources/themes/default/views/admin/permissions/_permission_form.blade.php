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
                {!! Form::label('display_name', trans('admin/routes/general.columns.display_name')) !!}
                {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', trans('admin/routes/general.columns.description')) !!}
                {!! Form::text('description', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('enabled', trans('admin/routes/general.columns.enabled')) !!}
                {!! Form::text('enabled', null, ['class' => 'form-control']) !!}
            </div>

        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div>
