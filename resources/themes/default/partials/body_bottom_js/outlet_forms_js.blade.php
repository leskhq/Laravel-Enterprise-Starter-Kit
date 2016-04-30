<!-- autocomplete UI -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#user_name').autocomplete({
            source   : '/admin/users/search',
            minLength: 3,
            autoFocus: true,
            select:function(e,ui){
                // asigning input column from the data that we got above
                $('#user_id').val(ui.item.id);
            }
        });

        $('#user_name').focusout(function() {
            if ($(this).val() == '') {
                $('#user_id').val(null);
            }
        });
    });
</script>