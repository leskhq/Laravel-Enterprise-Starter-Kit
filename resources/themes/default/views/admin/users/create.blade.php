@extends('layouts.master')

@section('head_extra')
    @include('partials.head_extra_select2_css')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::open( ['route' => 'admin.users.store', 'id' => 'form_edit_user'] ) !!}

                {!! Form::hidden('redirects_to', $previousURL, ['id' => 'redirects_to']) !!}

                @include('admin.users._user_form')

                <div class="form-group">
                    {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-edit'] ) !!}
                    {!! Form::button(trans('general.button.cancel'), ['class' => 'btn btn-default', 'id' => 'btn-cancel-create']) !!}
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

    <script type="text/javascript">
        $("#btn-cancel-create").on("click", function () {
            // Return to page stored in redirect hidden field.
            window.location.href = $("#redirects_to").val();
        });
    </script>

@endsection
