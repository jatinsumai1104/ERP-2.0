var customerTable = $("#customer_list");
console.log('Hello');
customerTable.on('click', '#edit', function(e){
    console.log('Hello');
    $id = $(this).attr('id');
    $("#edit_category_id").val($id);
    //fetching all other values from database using ajax and loading them onto their respective edit fields!
    //alert($id); to print for checking
    $.ajax({
        url:"http://localhost/erp/pages/scripts/category/fetch.php",
        method: "POST",
        data: {category_id:$id},
        dataType: "json",
        success: function(data){
            $("#category_name").val(data.category_name);
            $("#hsn_code").val(data.hsn_code);
            $("#gst_rate").val(data.gst_rate);
            $("#editModal").modal('show');
        },
    });
});
customerTable.on('click', '#delete', function(e){
    $id = $(this).attr('id');
    // console.log($id);
    // alert($id);
    // alert($("#recordID").val($id));
    $("#recordID").val($id);
});