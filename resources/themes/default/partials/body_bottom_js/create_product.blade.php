<!-- autocomplete UI -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#supplier').autocomplete({
            source   : '/admin/suppliers/search',
            minLength: 3,
            autoFocus: true,
            select:function(e,ui){
                // asigning input column from the data that we got above
                $('#supplier_id').val(ui.item.id);
            }
        });

        $('#supplier').focusout(function() {
            if ($(this).val() == '') {
                $('#supplier_id').val(null);
            }
        });
    });
</script>