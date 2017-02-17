@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.min.css">
    <!-- autocomplete ui css -->
    @include('partials.head_css.autocomplete_css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" style="float:none;margin:0 auto;">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/sales/general.page.edit.section-title') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                {!! Form::model($sale, ['route' => ['admin.sales.update', $sale->id], 'method' => 'PATCH']) !!}

                    @include('partials.forms.sale_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.edit'), ['class' => 'btn btn-primary'] ) !!}
                        <a href="{!! route('admin.sales.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <!-- Select2 4.0.0 -->
    <script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete').click(function(event){
              var id    = $(this).data('id');
              $("#row"+id).fadeOut('slow', function(){
                $("#row"+id).remove();
              });

              return false;
              event.stopPropagation();
            });
        });

        $('.product').change(function() {
            var currentId = $(this).attr('id').replace('product','');

            $('#product'+currentId).removeAttr('style');

            // empty the product id column
            $('#productName'+currentId).val('');
            $('#productName'+currentId).attr('weight', '');

            // empty all the column in the same row.
            $('#price'+currentId).val('');
            $('#displayPrice'+currentId).val('');
            $('#total'+currentId).val('');
            $('#displayTotal'+currentId).val('');
            $('#weight'+currentId).val('');
            $('#displayWeight'+currentId).val('');

            productValidation(currentId);
        });
    </script>

    @include('partials.body_bottom_js.sale_forms_js')
@endsection
