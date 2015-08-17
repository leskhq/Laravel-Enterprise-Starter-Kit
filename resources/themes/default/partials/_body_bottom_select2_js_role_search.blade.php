<!-- Select2 4.0.0 -->
<script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

<script type="text/javascript">
    $('#role_search').select2({
        theme: "bootstrap",
        placeholder: 'Search roles...',
        minimumInputLength: 3,
        ajax: {
            delay: 250,
            url: '/admin/roles/search',
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

    $("#btn-add-role").on("click", function () {
        // Get text.
        var selectedText  = $('#role_search :selected').text();
        // Get ID.
        var selectedValue = $('#role_search').val();
        // Build URL based on route and replace "{role}" with ID.
        var urlShowRole = '{!! route("admin.roles.show") !!}'.replace('%7Broles%7D', selectedValue);

        // Build table cells.
        var idCell     = '<td class="hidden">' + selectedValue + '</td>';
        var nameCel    = '<td>' + '<a href="' + urlShowRole + '">' + selectedText + '</a>' + '</td>';
        var descCel    = '<td></td>';
        var enabledCel = '<td></td>';
        var actionCel  = '<td style="text-align: right"><a class="btn-remove-role" href="#" title="{{ trans('general.button.remove-role') }}"><i class="fa fa-trash-o"></i></a></td>';

        // Add selected item only if not already in list.
        if ( $('#tbl-roles tr > td:contains(' + selectedValue + ')').length == 0 ) {
            $('#tbl-roles > tbody:last-child').append('<tr>' + idCell + nameCel + descCel + enabledCel + actionCel + '</tr>');
        }
    });

    $('body').on('click', 'a.btn-remove-role', function() {
        $(this).parent().parent().remove();
    });
</script>
