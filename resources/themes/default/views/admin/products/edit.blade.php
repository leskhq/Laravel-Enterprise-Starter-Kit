@extends('layouts.master')

@section('head_extra')
    <!-- autocomplete ui css -->
    @include('partials.head_css.autocomplete_css')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8" style="float:none;margin:0 auto;">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/products/general.page.edit.section-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
                    {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

                    @include('partials.forms.product_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.edit'), ['class' => 'btn btn-primary'] ) !!}
                        <a href="{!! route('admin.products.index',1) !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                    {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

@endsection

@section('body_bottom')
    @include('partials.body_bottom_js.create_product')
@endsection