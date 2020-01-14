var table = $("#dataTable");
table.on("click", ".delete", function(e) {
  $id = $(this).attr("id");
  console.log($id);
  $("#recordId").val($id);
});
