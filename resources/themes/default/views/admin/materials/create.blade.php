@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/materials/general.page.create.section-title') }}</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body" id="form">

                    {!! Form::open( ['route' => 'admin.materials.store'] ) !!}

                    @include('partials.forms.material_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.create'), ['class' => 'btn btn-primary', 'id' => 'btn-submit'] ) !!}
                        <a href="{!! route('admin.materials.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                    {!! Form::close() !!}

                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
@endsection