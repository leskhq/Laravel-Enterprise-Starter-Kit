@extends('layouts.master')

@section('head_extra')
    <!-- autocomplete ui css -->
    @include('partials.head_css.autocomplete_css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/outlets/general.page.create.section-title') }}</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                {!! Form::open(['route' => 'admin.outlets.store']) !!}

                    @include('partials.forms.outlet_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary'] ) !!}
                        <a href="{!! route('admin.outlets.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    @include('partials.body_bottom_js.outlet_forms_js')
@endsection