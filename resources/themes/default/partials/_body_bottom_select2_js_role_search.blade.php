
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
        var roleName, roleDesc, roleEnabled, roleStatus, idCell, nameCel, descCel, enabledCel, actionCel;
        // Get ID.
        var roleID = $('#role_search').val();
        // Build URL based on route and replace "{role}" with ID.
        var urlShowRole = '{!! route("admin.roles.show") !!}'.replace('%7Broles%7D', roleID);
        // Capture CSRF token from meta header.
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // Parse table values based on selected text.
        $.ajax({
            url: '{!! route("admin.roles.get-info") !!}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                id: roleID
            },
            dataType: 'JSON',
            success: function (data) {
//                console.log(data);
                roleName = data['display_name'];
                roleDesc = data['description'];
                roleEnabled = data['enabled'];

                if(1 == roleEnabled) {
                    roleStatus = '<i class="fa fa-check text-green"></i>';
                }
                else {
                    roleStatus = '<i class="fa fa-close text-red"></i>';
                }

                // Build table cells.
                idCell     = '<td class="hidden" rowname="id">' + roleID + '</td>';
                nameCel    = '<td>' + '<a href="' + urlShowRole + '">' + roleName + '</a>' + '</td>';
                descCel    = '<td>' + '<a href="' + urlShowRole + '">' + roleDesc + '</a>' + '</td>';
                enabledCel = '<td>' + roleStatus + '</td>';
                actionCel  = '<td style="text-align: right"><a class="btn-remove-role" href="#" title="{{ trans('general.button.remove-role') }}"><i class="fa fa-trash-o deletable"></i></a></td>';

                // Add selected item only if not already in list.
                if ( $('#tbl-roles tr > td[rowname="id"]:contains(' + roleID + ')').length == 0 ) {
                    $('#tbl-roles > tbody:last-child').append('<tr>' + idCell + nameCel + descCel + enabledCel + actionCel + '</tr>');
                }

            }
        });
    });

    $('body').on('click', 'a.btn-remove-role', function() {
        $(this).parent().parent().remove();
    });
</script>
