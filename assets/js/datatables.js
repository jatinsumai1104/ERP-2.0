var table = $("#dataTable");
table.on("click", ".delete", function(e) {
  $id = $(this).attr("id");
  console.log($id);
  $("#recordId").val($id);
});
table.on("click", ".edit", function(e) {
  $id = $(this).attr("id");
  $("#editId").val($id);
  $table_name = $(this).attr("table_name");
  console.log($table_name);
  //fetching all other values from database using ajax and loading them onto their respective edit fields!
  //alert($id); to print for checking
  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: { getDetails: true, id: $id, table_name: $table_name },
    dataType: "json",
    success: function(data) {
      if($table_name=="Product"){
        $("#name").val(data.name);
        $("#specification").val(data.specification);
        $("#old_selling_rate").val(data.psr.selling_rate);
        $("#selling_rate").val(data.psr.selling_rate);
        $("#wef").val(data.psr.wef);
        $("#eoq_level").val(data.eoq_level);
        $("#danger_level").val(data.danger_level);
      }
    },
    error: function(error) {
      console.log(error);
    }
  });
});
