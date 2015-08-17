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

    $("#btn-add-role").on("click", function () {
        var selectedText  = $('#role_search :selected').text();
        var selectedValue = $('#role_search').val();


        // Add selected item only if not already in list.
        if ( $("#users option[value='" + selectedValue + "']").length == 0 ){
            $('#users').append($('<option>', {
                value: selectedValue,
                text: selectedText
            }));
        }
    });

    $("#btn-remove-user").on("click", function () {
        $('#users option:selected').remove();
    });

</script>
