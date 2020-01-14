var customerTable = $("#customer_list");

customerTable.on('click', '#delete', function(e){
    $id = $(this).attr('id');
    // console.log($id);
    // alert($id);
    // alert($("#recordID").val($id));
    $("#recordID").val($id);
});