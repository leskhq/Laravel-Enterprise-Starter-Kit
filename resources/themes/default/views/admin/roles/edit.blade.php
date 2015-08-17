@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::model( $role, ['route' => ['admin.roles.update', $role->id], 'method' => 'PATCH', 'id' => 'form_edit_role'] ) !!}

                @include('partials._role_form')

                <div class="form-group">
                    {!! Form::button( trans('general.button.update'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                    <a href="{!! route('admin.roles.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
    <!-- Select2 js -->
    @include('partials._body_bottom_select2_js_user_search')
    @include('partials._body_bottom_submit_role_edit_form_js')

@endsection
