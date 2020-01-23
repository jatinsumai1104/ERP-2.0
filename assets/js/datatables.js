var table = $("#dataTable");

table.on("click", ".delete", function(e) {
  $("#recordId").val($(this).attr("id"));
  $("#delete_class_name").val($(this).attr("class_name"));
});

table.on("click", ".edit", function(e) {
  $id = $(this).attr("id");
  $("#editId").val($id);
  $class_name = $(this).attr("class_name");
  $("#edit_class_name").val($class_name);

  //fetching all other values from database using ajax and loading them onto their respective edit fields!
  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: { getDetails: true, id: $id, class_name: $class_name },
    dataType: "json",
    success: function(data) {
      console.log(data);
      if ($class_name == "Product") {
        $("#name").val(data.name);
        $("#specification").val(data.specification);
        $("#old_selling_rate").val(data.psr.selling_rate);
        $("#selling_rate").val(data.psr.selling_rate);
        $("#wef").val(data.psr.wef);
        $("#eoq_level").val(data.eoq_level);
        $("#danger_level").val(data.danger_level);
      } else if ($class_name == "Category") {
        $("#name").val(data.name);
      }
    },
    error: function(error) {
      console.log("Error");
      console.log(error);
    }
  });
});
