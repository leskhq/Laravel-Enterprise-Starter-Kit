@extends('layouts.master')

@section('head_extra')
    @include('partials._head_extra_jstree_css')
    @include('partials._head_extra_select2_css')
@endsection

@section('content')

    <div class='row'>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/menu-builder/menu-builder.page.index.hierarchy') }}</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">

                    <div id="jstree_menu_div"></div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/menu-builder/menu-builder.page.index.details') }}</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::open( ['route' => 'admin.menus.save', 'id' => 'form_save_menu'] ) !!}
                        {!! Form::hidden('id', null, ['class' => 'form-control', 'id' => 'id']) !!}

                        <div class="form-group">
                            {!! Form::label('name', trans('admin/menu-builder/menu-builder.columns.name') ) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('label', trans('admin/menu-builder/menu-builder.columns.label') ) !!}
                            {!! Form::text('label', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('position', trans('admin/menu-builder/menu-builder.columns.position') ) !!}
                            {!! Form::text('position', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('icon', trans('admin/menu-builder/menu-builder.columns.icon') ) !!}
                            {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label>
                                {!! '<input type="hidden" name="separator" value="0">' !!}
                                {!! Form::checkbox('separator', '1', false, ['id' => 'separator']) !!} {{ trans('admin/menu-builder/menu-builder.columns.separator') }}
                            </label>
                        </div>

                        <div class="form-group">
                            {!! Form::label('url', trans('admin/menu-builder/menu-builder.columns.url') ) !!}
                            {!! Form::text('url', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label>
                                {!! '<input type="hidden" name="enabled" value="0">' !!}
                                {!! Form::checkbox('enabled', '1', false, ['id' => 'enabled']) !!} {{ trans('admin/menu-builder/menu-builder.columns.enabled') }}
                            </label>
                        </div>

                        <div class="form-group">
                            {!! Form::label('parent_id', trans('admin/menu-builder/menu-builder.columns.parent') ) !!}
                            {!! Form::select( 'parent_id', $parents, null, ['class' => 'js-parents form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('route_id', trans('admin/menu-builder/menu-builder.columns.route') ) !!}
                            {!! Form::select( 'route_id', $routes, null, ['class' => 'js-routes form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('permission_id', trans('admin/menu-builder/menu-builder.columns.permission') ) !!}
                            {!! Form::select( 'permission_id', $permissions, null, ['class' => 'js-permissions form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit( trans('general.button.save'), ['class' => 'btn btn-primary', 'id' => 'btn-submit-save'] ) !!}
                            <a id="deleteAnchor" disabled  data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}" class='btn btn-default'>{{ trans('general.button.delete') }}</a>
                            <a id="resetFormAnchor" disabled onclick="resetForm($('#form_save_menu'))"  title="{{ trans('general.button.clear') }}" class='btn btn-default'>{{ trans('general.button.clear') }}</a>
                        </div>

                    {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')

    <!-- Select2 4.0.0 -->
    <script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".js-parents").select2();
        });
        $(document).ready(function() {
            $(".js-routes").select2();
        });
        $(document).ready(function() {
            $(".js-permissions").select2();
        });
    </script>

    <!-- JSTree 3.2.1 -->
    <script src="{{ asset ("/jstree/dist/jstree.min.js") }}"></script>

    <!-- Build and configure JSTree -->
    <script language="JavaScript">
        $('#jstree_menu_div').jstree({
            'core' : {
                'themes' : {
                    'name': 'default',
                    'responsive': true
                },
                'data' : {!! $menusJson !!}
            }
        }).bind("loaded.jstree", function (event, data) {
            // Once jsTree is loaded, send command to expend all nodes.
            $(this).jstree("open_all");
        });
    </script>

    <!-- Load menu details into edit form when user clicks on tree node. -->
    <script language="JavaScript">
        $('#jstree_menu_div').on("select_node.jstree", function (e, nodeSelected) {

            // Capture CSRF token from meta header.
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // Build URLs based on selected menu and replace "{menuId}" with ID.
            var urlShowRoute = '{!! route("admin.menus.get-data") !!}'.replace('%7BmenuId%7D', nodeSelected.selected);
            var urlDeleteRoute = '{!! route("admin.menus.confirm-delete") !!}'.replace('%7BmenuId%7D', nodeSelected.selected);



            $.ajax({
                url: urlShowRoute,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: nodeSelected.selected
                },
                dataType: 'JSON',
                success: function (returnData) {

                    menuObject = returnData[0];
                    menuID              = menuObject.id;
                    menuName            = menuObject.name;
                    menuLabel           = menuObject.label;
                    menuPosition        = menuObject.position;
                    menuIcon            = menuObject.icon;
                    menuURL             = menuObject.url;
                    menuSeparator       = (1 == menuObject.separator);
                    menuEnabled         = (1 == menuObject.enabled);
                    menuParentID        = menuObject.parent_id;
                    menuRouteID         = menuObject.route_id;
                    menuPermissionID    = menuObject.permission_id;
                    menuParentName      = ( menuObject.parent )     ? menuObject.parent.name     : '';
                    menuRouteName       = ( menuObject.route )      ? menuObject.route.name      : '';
                    menuPermissionName  = ( menuObject.permission ) ? menuObject.permission.name : '';

                    $('#id').val(menuID);
                    $('#name').val(menuName);
                    $('#label').val(menuLabel);
                    $('#position').val(menuPosition);
                    $('#icon').val(menuIcon);
                    $('#separator').prop('checked', menuSeparator);
                    $('#url').val(menuURL);
                    $('#enabled').prop('checked', menuEnabled);

                    $(".js-parents").val(menuParentID).trigger("change");
                    $(".js-routes").val(menuRouteID).trigger("change");
                    $(".js-permissions").val(menuPermissionID).trigger("change");

                    enableAnchor($("#deleteAnchor"), urlDeleteRoute);
                    enableAnchor($("#resetFormAnchor"), null, "resetForm($('#form_save_menu'))");
                }
            });

        });
    </script>

    <script language="JavaScript">
        // Reset the form.
        function resetForm($form)
        {
            $form.trigger("reset");
            $('#id').val('');
            $(".js-parents").val('1').trigger("change"); // Reset to root
            $(".js-routes").val('blank').trigger("change"); // Reset to blank.
            $(".js-permissions").val('blank').trigger("change"); // Reset to blank.
            disableAnchor($("#deleteAnchor"));
            disableAnchor($("#resetFormAnchor"));
            return false;
        }

        // Disable anchor tag
        function disableAnchor($anchor)
        {
            // Disable and remove href.
            $anchor.removeAttr("href").attr('disabled', 'disabled');
        }

        function enableAnchor($anchor, $href, $onclick) {
            $anchor.removeAttr("disabled");
            if ($href) {
                $anchor.attr("href", $href);
            }
            if ($onclick) {
                $anchor.attr("onclick", $onclick);
            }
        }


        // Set elements to startup state and value on page load.
        $(document).ready(function(){
//            disableAnchor($("#deleteAnchor"));
//            disableAnchor($("#resetFormAnchor"));
            resetForm($("form_save_menu"));
        });
    </script>
@endsection
