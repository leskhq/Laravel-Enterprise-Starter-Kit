
<script type="text/javascript">
    $("#btn-submit-edit").on("click", function () {
        var users=[], id;
        // Collect all IDs from first column.
        $('#tbl-users tr').each(function() {
            id = $(this).find("td:first").html();
            if (id) {
                users.push(id);
            }
        });
        // Join all users from array to hidden field separated by a comma.
        $('#selected_users').val(users.join(','));
        // Post form.
        $("#form_edit_role").submit();
    });
</script>

