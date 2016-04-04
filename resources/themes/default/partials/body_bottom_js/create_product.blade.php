<script type="text/javascript" src="{{  asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}"></script>
<script type="text/javascript">
    $('#supplier').select2({
        theme: "bootstrap",
        placeholder: 'Search supplier...',
        minimumInputLength: 3,
        ajax: {
            delay: 250,
            url: '/admin/suppliers/search',
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
</script>