var id = 2;
function addPurchase() {
  $("#purchase_product").append(
    '<div class="row" id="element_' +
      id +
      '"> <div class="col-md-4"> <div class="form-group"> <label for="">Category</label> <select name="category_id" id="category_' +
      id +
      '" class="form-control category_class"> <option disabled selected>Select Category</option> </select> </div></div><div class="col-md-4"> <div class="form-group"> <label for="">Product</label> <select name="product_id[]" id="product_' +
      id +
      '" class="form-control product_class"> <option disabled selected>Select Product</option> </select> </div></div><div class="col-md-4"> <div class="form-group"> <label for="">Quantity</label> <input type="number" class="form-control" name="quantity[]" id="quantity" aria-describedby="helpId" placeholder=""> </div></div><div class="col-md-4"> <div class="form-group"> <label for="">Discount</label> <input type="number" class="form-control" name="discount[]" id="discount" aria-describedby="helpId" placeholder=""> </div></div><div class="col-md-4" style="text-align: center"> <button type="button" class="btn btn-danger" style="margin-top: 8%;" onclick="deletePurchase(' +
      id +
      ')"> <i class="far fa-trash-alt"></i> Delete Element </button> </div></div>'
  );
  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: { getCategories: true },
    dataType: "json",
    success: function(data) {
      data.forEach(function(item, index) {
        $("#category_" + id).append(
          "<option value='" + item.id + "'>" + item.name + "</option>"
        );
      });
      id++;
    },
    error: function(error) {
      console.log(error);
    }
  });
}

function deletePurchase(delete_id) {
  $("#element_" + delete_id).remove();
}

$("#purchase_product").on("change", ".category_class", function() {
  $element_id = $(this)
    .attr("id")
    .split("_")[1];
  $id = this.value;
  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: { getProductByCategoryId: true, category_id: $id },
    dataType: "json",
    success: function(data) {
      // console.log(data);
      data.forEach(function(item, index) {
        $("#product_" + $element_id).append(
          "<option value='" + item.id + "'>" + item.name + "</option>"
        );
      });
    },
    error: function(error) {
      console.log(error);
    }
  });
});

$("#check_email").click(function(){
   $email = $("#customer_email").val();
   //console.log($email);
  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: { checkEmailOfCustomer: true, customer_email: $email },
    dataType: "json",
    success: function(data) {
        $("#customer_exist").empty();
        if(data.email_id != null){
            $("#customer_exist").html(data.email_id+" is verified");
            $("#customer_id").val(data.id);
        }else{
            $("#customer_exist").html("This email id is not present");
        }
      
    },
    error: function(error) {
      console.log(error);
    }
  });
});


$("#get_total_amount").click(function(){
  $product_id = [];
  $quantity_id = [];
  $discount_id = [];
  $('select[name="product_id[]"]').each(function() {
    //console.log($(this).val());
    $product_id.push($(this).val());
});
$('input[name="quantity[]"]').each(function() {
  //console.log($(this).val());
  $quantity_id.push($(this).val());
});
$('input[name="discount[]"]').each(function() {
  //console.log($(this).val());
  $discount_id.push($(this).val());
});
// console.log($product_id);
// console.log($quantity_id);
// console.log($discount_id);
  
 $.ajax({
   url: "http://localhost/oop-php-erp/helper/routing.php",
   method: "POST",
   data: { get_total_amount: true, product_id: $product_id, quantity_id:$quantity_id, discount_id:$discount_id },
   dataType: "json",
   success: function(data) {
       $("#total_price").empty();
       $("#total_price").val(data);
       
   },
   error: function(error) {
     console.log(error);
   }
 });
});
