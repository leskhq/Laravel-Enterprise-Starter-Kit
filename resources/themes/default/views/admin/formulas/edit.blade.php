@extends('layouts.master')

@section('head_extra')
    <!-- autocomplete ui css -->
    @include('partials.head_css.autocomplete_css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/formulas/general.page.edit.section-title') }}</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body" id="form" data-id="{{ $formula->id }}">

                    {!! Form::model($formula, ['route' => ['admin.formulas.update', $formula->id], 'id' => 'form_create_formula', 'method' => 'PATCH'] ) !!}

                    @include('partials.forms.formula_form')

                    <div class="form-group">
                        {!! Form::submit( trans('general.button.update'), ['class' => 'btn btn-primary', 'id' => 'btn-submit'] ) !!}
                        <a href="{!! route('admin.formulas.index') !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default'>{{ trans('general.button.cancel') }}</a>
                    </div>

                    {!! Form::close() !!}
                <pre>
                    @{{ $data | json }}
                </pre>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    @include('partials.body_bottom_js.formula_form_js')

    <script type="text/javascript">
        function fetchData() {
            var id = $('#form').data('id');
            console.log(id);
            $.ajax({
                url : '/admin/formulas/' + id + '/get-materials',
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