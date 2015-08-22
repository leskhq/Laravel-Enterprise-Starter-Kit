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
        // Get text.
        var selectedText  = $('#route_search :selected').text();
        // Get ID.
        var selectedValue = $('#route_search').val();
        // Build URL based on route and replace "{route}" with ID.
        var urlShowRoute = '{!! route("admin.routes.show") !!}'.replace('%7Broutes%7D', selectedValue);

        // Build table cells.
        var idCell     = '<td class="hidden">' + selectedValue + '</td>';
        var nameCel    = '<td>' + '<a href="' + urlShowRoute + '">' + selectedText + '</a>' + '</td>';
        var descCel    = '<td></td>';
        var enabledCel = '<td></td>';
        var actionCel  = '<td style="text-align: right"><a class="btn-remove-route" href="#" title="{{ trans('general.button.remove-route') }}"><i class="fa fa-trash-o"></i></a></td>';

        // Add selected item only if not already in list.
        if ( $('#tbl-routes tr > td:contains(' + selectedValue + ')').length == 0 ) {
            $('#tbl-routes > tbody:last-child').append('<tr>' + idCell + nameCel + descCel + enabledCel + actionCel + '</tr>');
        }
    });

    $('body').on('click', 'a.btn-remove-route', function() {
        $(this).parent().parent().remove();
    });
</script>
