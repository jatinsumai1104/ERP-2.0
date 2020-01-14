var customerTable = $("#customer_list");

customerTable.on('click', '.edit', function(e){
    $id = $(this).attr("id");
    $("#editId").val($id);
    $table_name = $(this).attr("table_name");
    $.ajax({
        url: "http://localhost/oop-php-erp/helper/routing.php",
        method: "POST",
        data: { getDetails: true, id: $id, table_name: $table_name },
        dataType: "json",
        success: function(data) {
            console.log(data);
            if($table_name=="customers"){
                $("#first_name").val(data.first_name);
                $("#last_name").val(data.last_name);
                $("#gst_no").val(data.gst_no);
                $("#phone_no").val(data.phone_no);
                $("#email_id").val(data.email_id);
                $("#gender").val(data.gender);
            }else if($table_name=="products"){
                $("#product_name").val(data.name);
                $("#specification").val(data.specification);
                $("#selling_rate").val(data.selling_rate);
                $("#eoq_level").val(data.eoq_level);
                $("#danger_level").val(data.danger_level);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});

customerTable.on('click', '.delete', function(e){
    $id = $(this).attr('id');
    $("#recordID").val($id);
});
