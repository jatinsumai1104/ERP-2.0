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
      $("#product_" + $element_id).empty();
      $("#product_" + $element_id).append(
        "<option disabled selected>Select Product</option>"
      );
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

$("#check_email").click(function() {
  $email = $("#customer_email").val();
  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: { checkEmailOfCustomer: true, customer_email: $email },
    dataType: "json",
    success: function(data) {
      $("#customer_exist").empty();
      if (data.email_id != null) {
        $("#email_verified_fail").css("display", "none");
        $("#add_customer").css("display", "none");
        $("#email_verified_success").css("display", "inline");
        $("#customer_id").val(data.id);
      } else {
        $("#customer_id").val("");
        $("#email_verified_success").css("display", "none");
        $("#add_customer").css("display", "inline-block");
        $("#email_verified_fail").css("display", "inline");
      }
    },
    error: function(error) {
      console.log(error);
    }
  });
});

$("#get_total_amount").click(function() {
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

  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: {
      get_total_amount: true,
      product_id: $product_id,
      quantity_id: $quantity_id,
      discount_id: $discount_id
    },
    dataType: "json",
    success: function(data) {
      // $("#total_price").empty();
      $("#total_price").html(data);
      $("#total_price_input")
        .empty()
        .val(data);
    },
    error: function(error) {
      console.log(error);
    }
  });
});

$("#payment_mode").change(function() {
  $payment_mode = $(this).val();
  //console.log($payment_mode);
  if ($payment_mode == "cash") {
    $("#payment-div").empty();
  } else if ($payment_mode == "cheque") {
    $("#payment-div").append(
      '<label for="">Cheque Number</label> <input type="number" name="cheque_no"> <label for="">Cheque Date</label> <input type="date" name="cheque_date"> <label for="">Bank Name</label> <input type="text" name="bank_name"> '
    );
  }
});
