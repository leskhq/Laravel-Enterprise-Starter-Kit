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

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <!-- Trick to force cleared checkbox to being posted in form! It will be posted as zero unless checked then posted again as 1 and since only last one count! -->
                        {!! '<input type="hidden" name="encrypted" value="0">' !!}
                        {!! Form::checkbox('encrypted', '1', Setting::isEncrypted($key)) !!} {!! trans('admin/settings/general.columns.encrypted') !!}
                    </label>
                </div>
            </div>

        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div> <!-- row -->

