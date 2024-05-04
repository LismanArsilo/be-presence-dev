/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function() {
  // Handle Modal Details
  $(".btnDetail").on("click", function() {
    $("#modal-detail").modal("show");
  });

  $(".btnDelete").on("click", function() {
    $("#modal-danger").modal("show");
  });
});