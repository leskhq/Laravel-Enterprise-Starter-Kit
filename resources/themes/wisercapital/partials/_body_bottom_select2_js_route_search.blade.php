<!-- Select2 4.0.0 -->
<script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

<script type="text/javascript">
    $('#route_search').select2({
        theme: "bootstrap",
        placeholder: 'Search routes...',
        minimumInputLength: 3,
        ajax: {
            delay: 250,
            url: '/admin/routes/search',
            dataType: 'json',
            data: function (params) {
                var queryParameters = {
                    query: params.term
                };

                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        tags: true
    });

    $("#btn-add-route").on("click", function () {
        var routeMethod, routePath, routeEnabled, routeStatus, idCell, methodCel, pathCel, enabledCel, actionCel;
        // Get ID.
        var routeID = $('#route_search').val();
        // Build URL based on route and replace "{route}" with ID.
        var urlShowRoute = '{!! route("admin.routes.show") !!}'.replace('%7Broutes%7D', routeID);
        // Capture CSRF token from meta header.
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // Parse table values based on selected text.
        $.ajax({
            url: '{!! route("admin.routes.get-info") !!}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                id: routeID
            },
            dataType: 'JSON',
            success: function (data) {
//                console.log(data);
                routeMethod  = data['method'];
                routePath    = data['path'];
                routeEnabled = data['enabled'];

                if(1 == routeEnabled) {
                    routeStatus = '<i class="fa fa-check text-green"></i>';
                }
                else {
                    routeStatus = '<i class="fa fa-close text-red"></i>';
                }

                // Build table cells.
                idCell     = '<td class="hidden" rowname="id">' + routeID + '</td>';
                methodCel    = '<td>' + '<a href="' + urlShowRoute + '">' + routeMethod + '</a>' + '</td>';
                pathCel    = '<td>' + '<a href="' + urlShowRoute + '">' + routePath + '</a>' + '</td>';
                enabledCel = '<td>' + routeStatus + '</td>';
                actionCel  = '<td style="text-align: right"><a class="btn-remove-route" href="#" title="{{ trans('general.button.remove-route') }}"><i class="fa fa-trash-o deletable"></i></a></td>';

                // Add selected item only if not already in list.
                if ( $('#tbl-routes tr > td[rowname="id"]:contains(' + routeID + ')').length == 0 ) {
                    $('#tbl-routes > tbody:last-child').append('<tr>' + idCell + methodCel + pathCel + enabledCel + actionCel + '</tr>');
                }

            }
        });

    });

    $('body').on('click', 'a.btn-remove-route', function() {
        $(this).parent().parent().remove();
    });
</script>
