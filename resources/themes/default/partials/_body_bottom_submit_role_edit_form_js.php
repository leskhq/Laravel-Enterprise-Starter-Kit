
<script type="text/javascript">
    $("#btn-submit-edit").on("click", function () {
        // Select all options (users) in the list box to post them.
        $('#users option').prop('selected', true);
        // Post form.
        $("#form_edit_role").submit();
    });
</script>

