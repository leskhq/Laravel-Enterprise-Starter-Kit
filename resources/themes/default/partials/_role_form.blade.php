<?php $readonly = ($role->isEditable())? '' : 'readonly'; ?>
<?php $membershipFixed = ($role->canChangeMembership())? '' : 'disabled'; ?>

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.details') !!}</a></li>
        <li class=""><a href="#tab_options" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.options') !!}</a></li>
        <li class=""><a href="#tab_perms" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.perms') !!}</a></li>
        <li class=""><a href="#tab_users" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.users') !!}</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="tab_details">
            <div class="form-group">
                {!! Form::label('name', trans('admin/roles/general.columns.name') ) !!}
                {!! Form::text('name', null, ['class' => 'form-control', $readonly]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('display_name', trans('admin/roles/general.columns.display_name') ) !!}
                {!! Form::text('display_name', null, ['class' => 'form-control', $readonly]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', trans('admin/roles/general.columns.description') ) !!}
                {!! Form::text('description', null, ['class' => 'form-control', $readonly]) !!}
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_options">
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {!! '<input type="hidden" name="resync_on_login" value="0">' !!}
                        {!! Form::checkbox('resync_on_login', '1', $role->resync_on_login) !!} {{ trans('admin/roles/general.columns.resync_on_login') }}
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        {!! '<input type="hidden" name="enabled" value="0">' !!}
                        {!! Form::checkbox('enabled', '1', $role->enabled) !!} {{ trans('general.status.enabled') }}
                    </label>
                </div>
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_perms">
            <div class="form-group">
                @foreach($perms as $perm)
                    <?php $disabled = ($perm->canBeAssigned()) ? '' : 'disabled'; ?>
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('perms[]', $perm->id, $role->hasPerm($perm), ( \App\Models\Permission::isForced($perm) || (!$perm->canBeAssigned()) )? ['disabled'] : null ) !!} {{ $perm->display_name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_users">
            <div class="form-group">
                <div class="input-group select2-bootstrap-append">
                    {!! Form::select('user_search', $userList, null, ['class' => 'form-control', 'id' => 'user_search',  'style' => "width: 100%", $membershipFixed]) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="btn-add-user" type="button" {!! $membershipFixed !!}>
                            <span class="fa fa-plus-square"></span>
                        </button>
                        <button class="btn btn-default" id="btn-remove-user" type="button" {!! $membershipFixed !!}>
                            <span class="fa fa-minus-square"></span>
                        </button>
                    </span>
                </div>

                <div class="checkbox">
                    <select multiple="multiple" name="users[]" id="users" class="form-control" style="width: 100%"  {!! $membershipFixed !!}>
                        @foreach($roleUsers as $user)
                            <option value="{!! $user->id !!}">{!! $user->full_name . " (" . $user->username . ")" !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div>




