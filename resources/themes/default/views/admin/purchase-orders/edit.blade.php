@extends('layouts.master')

@section('head_extra')
    <!-- autocomplete ui css -->
    @include('partials.head_css.autocomplete_css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" style="float:none;margin:0 auto;">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/purchase-orders/general.page.create.section-title') }}</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body" id="form" data-id="{{ $purchaseOrder->id }}">
                {!! Form::model($purchaseOrder, ['route' => ['admin.purchase-orders.update', $purchaseOrder->id], 'method' => 'PATCH']) !!}

                    @include('partials.forms.purchase-order_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.update'), ['class' => 'btn btn-primary'] ) !!}
                        <a href="{!! route('admin.purchase-orders.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    @include('partials.body_bottom_js.purchase_order_form_js')

    <script type="text/javascript">
        function fetchData() {
            var id = $('#form').data('id');
            $.ajax({
                url : '/admin/purchase-orders/' + id + '/get-details',
                type: 'GET',
                success: function(materials) {
                    vm.materials = materials;
                }
            });
        }

        $(document).ready(function() {
            fetchData();
        });
    </script>
@endsection