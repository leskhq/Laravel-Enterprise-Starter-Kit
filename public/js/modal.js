// Close or remove modal div.
$(function () {
    $("#modal_dialog").on('hidden.bs.modal', function () {
        $(this).data('bs.modal', null);
    });
});
