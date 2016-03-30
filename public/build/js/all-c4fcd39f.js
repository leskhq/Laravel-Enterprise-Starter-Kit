// Close or remove modal div.
$(function () {
    $("#modal_dialog").on('hidden.bs.modal', function () {
        $(this).data('bs.modal', null);
    });
});

(function() {
  if (typeof elvis !== "undefined" && elvis !== null) {
    alert("I knew it!");
  }

}).call(this);

//# sourceMappingURL=app.js.map

//# sourceMappingURL=all.js.map
