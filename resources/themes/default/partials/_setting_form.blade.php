<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_details">
            <div class="form-group">
                {!! Form::label('key', trans('admin/settings/general.columns.name') ) !!}
                {!! Form::text('key', $key, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('value', trans('admin/settings/general.columns.value') ) !!}
                {!! Form::text('value', $value, ['class' => 'form-control']) !!}
            </div>
        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div> <!-- row -->

