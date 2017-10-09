@extends('layouts.master')

@section('head_extra')
    @include('partials.head_extra_select2_css')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::open( ['route' => 'admin.users.store', 'id' => 'form_edit_user'] ) !!}

                @include('admin.users._user_form')

                <div class="form-group">
                    {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                    <a href="{!! route('admin.users.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('body_bottom')
    @include('partials.body_bottom_select2_css')
    @include('admin.users._body_bottom_select2_js_user_settings')
    @include('partials.body_bottom_tab_with_state_set_js')

@endsection
