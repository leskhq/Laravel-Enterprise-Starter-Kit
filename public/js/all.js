// Close or remove modal div.
$(function () {
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
});
(function() {
  if (typeof elvis !== "undefined" && elvis !== null) {
    alert("I knew it!");
  }

}).call(this);

//# sourceMappingURL=app.js.map
//# sourceMappingURL=all.js.map