@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( ['url' => url('admin/audits?search=1'), 'id' => 'frmAuditList'] ) !!}

                {!! Form::hidden('export_to_csv', "false", ['id' => 'export_to_csv']) !!}

                <button class="hidden_away" type="submit" title="{{ trans('general.button.filter-results') }}" id="btn-hidden-form-submit"></button>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">

                            <div class="col-sm-6">
                                <h3 class="box-title">{{ trans('admin/users/general.page.index.table-title') }}</h3>

                                @permission('core.p.audits.purge')
                                <a class="btn btn-default btn-sm" href="{!! route('admin.audits.purge') !!}" title="{{ trans('admin/audits/general.action.purge') }}">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                @else
                                    <a class="btn btn-default btn-sm" disabled="true"  href="#" title="{{ trans('admin/audits/general.action.no-permission-to-purge-audits') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                @endpermission
                            </div> <!-- col-sm-6 -->

                            <div class="col-sm-6">
                                {!! $filter->open !!}
                                    <div class="input-group custom-search-form">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit" title="{{ trans('general.button.export-results') }}" id="btn-export-to-csv">
                                                <span class="glyphicon glyphicon-export"></span>
                                            </button>
                                        </span>
                                        {!! $filter->field('srch') !!}
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                            <a href="{!! route('admin.audits.index') !!}" class="btn btn-default">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </span>
                                    </div>
                                {!! $filter->close !!}
                            </div> <!-- col-sm-6 -->

                        </div> <!-- row -->
                    </div>
                    <div class="box-body">
                        {!! $grid !!}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection

@section('body_bottom')
    @include('partials.body_bottom_tab_with_state_reset_js')

    <script type="text/javascript">
        $("#btn-export-to-csv").on("click", function () {
            // Set hidden form field.
            $('#export_to_csv').val("true");
            // Post form.
            $("#frmAuditList").submit();
        });
    </script>

@endsection
