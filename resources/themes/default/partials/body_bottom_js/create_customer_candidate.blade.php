<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="{{  asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}"></script>
<script type="text/javascript">
    $('.type').select2({
        theme: "bootstrap",
        placeholder: '...',
        tags: true
    });
    $('.date').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true
    });
</script>
