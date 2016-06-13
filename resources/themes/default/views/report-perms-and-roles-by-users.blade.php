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
                <div id="container_reportPermsRolesByUsersPivotGrid" class="box-body">
                    {{
                    GridRender::setGridId("PermsRolesByUsersPivotGrid")
                      ->enableFilterToolbar()
                      ->setGridOption('url', URL::to('/test-reports/perms-and-roles-by-users-data'))
                      ->setGridOption('rowNum', 10)
                      ->setGridOption('height', 300)
                      ->setGridOption('rowList', array(5,10,15,20))
                      ->setGridOption('caption', 'Perms and roles by users')
                      ->setGridOption('viewrecords', true)
                      ->setGridOption('grouping', true)
                      ->setGridOption('sortname','username')


                      ->setGridOption('groupingView',
                            [
                                "groupField"      => ['username', 'role'],
                                "groupColumnShow" => [true, true],
                                "groupText"       => ["User: <b>{0}</b>", "Role: <b>{0}</b>"],
                                "groupOrder"      =>  ["asc", "asc"],
                                "groupSummary"    => [false, false],
                                "groupCollapse"   => true,
                                 ] )


                      ->addColumn(array('label'=>'User name',       'index'=>'username',        'align'=>'left'))
                      ->addColumn(array('label'=>'User permission', 'index'=>'user_permission', 'align'=>'right'))
                      ->addColumn(array('label'=>'Role',            'index'=>'role',            'align'=>'right'))
                      ->addColumn(array('label'=>'Role permission', 'index'=>'role_permission', 'align'=>'right'))
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
            jQuery("#PermsRolesByUsersPivotGrid").setGridWidth($('#container_reportPermsRolesByUsersPivotGrid').width()-10, true);
        }).trigger('resize');
    </script>
@endsection
