<!-- Select2 4.0.0 -->
<script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>

<script type="text/javascript">
    $('#user_search').select2({
        theme: "bootstrap",
        placeholder: 'Search users...',
        minimumInputLength: 3,
        ajax: {
            delay: 250,
            url: '/admin/users/search',
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

    $("#btn-add-user").on("click", function () {
        // Get text.
        var selectedText  = $('#user_search :selected').text();
        // Get ID.
        var selectedValue = $('#user_search').val();
        // Build URL based on route and replace "{user}" with ID.
        var urlShowUser = '{!! route("admin.users.show") !!}'.replace('%7Busers%7D', selectedValue);

        // Build table cells.
        var idCell     = '<td class="hidden">' + selectedValue + '</td>';
        var nameCel    = '<td>' + '<a href="' + urlShowUser + '">' + selectedText + '</a>' + '</td>';
        var descCel    = '<td></td>';
        var enabledCel = '<td></td>';
        var actionCel  = '<td style="text-align: right"><a class="btn-remove-user" href="#" title="{{ trans('general.button.remove-user') }}"><i class="fa fa-trash-o"></i></a></td>';

        // Add selected item only if not already in list.
        if ( $('#tbl-users tr > td:contains(' + selectedValue + ')').length == 0 ) {
            $('#tbl-users > tbody:last-child').append('<tr>' + idCell + nameCel + descCel + enabledCel + actionCel + '</tr>');
        }
    });

    $('body').on('click', 'a.btn-remove-user', function() {
        $(this).parent().parent().remove();
    });
</script>
