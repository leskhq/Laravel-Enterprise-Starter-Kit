
<script type="text/javascript">

    $(document).ready(function() {

        $(".select-theme").select2({
            placeholder: '{{ trans('admin/users/general.placeholder.select-theme') }}',
            allowClear: true,
            width: '100%'
        });

        $(".select-time_zone").select2({
            placeholder: '{{ trans('admin/users/general.placeholder.select-time_zone') }}',
            allowClear: true,
            width: '100%'
        });

        $(".select-locale").select2({
            placeholder: '{{ trans('admin/users/general.placeholder.select-locale') }}',
            allowClear: true,
            width: '100%'
        });

    });
</script>
