
<script type="text/javascript">
    $("#btn-submit-edit").on("click", function () {
        var roles=[], id;
        // Collect all IDs from first column.
        $('#tbl-roles tr').each(function() {
            id = $(this).find("td:first").html();
            if (id) {
                roles.push(id);
            }
        });
        // Join all roles from array to hidden field separated by a comma.
        $('#selected_roles').val(roles.join(','));
        // Post form.
        $("#form_edit_user").submit();
    });
</script>

