@extends('layouts.master')


<!-- Optional bottom section for modals etc... -->
@section('head_extra')
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset("/jquery-ui/base/jquery-ui.min.css") }}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset("/jqgrid/css/ui.jqgrid.css") }}"/>

    <script type="text/javascript" src="{{ asset ("/jquery-ui/base/jquery-ui.min.js") }}"></script>

    <script type="text/javascript" src="{{ asset ("/jqgrid/js/i18n/grid.locale-en.js") }}"></script>
    <script type="text/javascript" src="{{ asset ("/jqgrid/js/jquery.jqGrid.min.js") }}"></script>


    <script language="JavaScript">
    </script>
@endsection


@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $page_title }}</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div id="container_reportUsersGrid" class="box-body">
                    {{
                    GridRender::setGridId("reportUsersGrid")
                      ->enableFilterToolbar()
                      ->setGridOption('url',URL::to('/test-reports/users-data'))
                      ->setGridOption('rowNum', 5)
                      ->setGridOption('shrinkToFit',false)
                      ->setGridOption('sortname','last_name')
                      ->setGridOption('caption','User report: simple')
                      ->setGridOption('useColSpanStyle', true)
                      ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                      ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                      ->setFilterToolbarOptions(array('autosearch'=>true))
                      ->setNavigatorEvent('view', 'beforeShowForm', 'function(){alert("Before show form");}')
                      ->setFilterToolbarEvent('beforeSearch', 'function(){alert("Before search event");}')
                      ->addColumn(array('label'=>'ID','name'=>'id', 'index'=>'id', 'width'=>55))
                      ->addColumn(array('label'=>'Last name','index'=>'last_name','width'=>100))
                      ->addColumn(array('label'=>'First name','index'=>'first_name','width'=>100))
                      ->addColumn(array('label'=>'Username','index'=>'username','width'=>100))
                      ->addColumn(array('label'=>'Email','index'=>'email','width'=>100))
                      ->addColumn(array('label'=>'Created at','index'=>'created_at','width'=>100))
                      ->addColumn(array('label'=>'Updated at','index'=>'updated_at','width'=>100))
                      ->addColumn(array('label'=>'Enabled','index'=>'enabled','width'=>100))
                      ->renderGrid()
                    }}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
    @endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <script language="JavaScript">
        $(window).bind('resize', function() {
            jQuery("#reportUsersGrid").setGridWidth($('#container_reportUsersGrid').width()-10, true);
        }).trigger('resize');
    </script>
@endsection
