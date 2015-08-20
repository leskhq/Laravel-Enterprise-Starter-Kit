// Close or remove modal div.
$(function () {
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
});