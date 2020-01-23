var id = 2;
function addPurchase() {
  $("#purchase_product").append(
    '<div class="row" id="element_' +
      id +
      '"> <div class="col-md-4"> <div class="form-group"> <label for="">Category</label> <select name="category_id[]" id="category_' +
      id +
      '" class="form-control category_class"> <option disabled selected>Select Category</option> </select> </div></div><div class="col-md-4"> <div class="form-group"> <label for="">Product</label> <select name="product_id[]" id="product_' +
      id +
      '" class="form-control product_class"> <option disabled selected>Select Product</option> </select> </div></div><div class="col-md-4"> <div class="form-group"> <label for="">Supplier</label> <select name="supplier_id[]" id="supplier_' +
      id +
      '" class="form-control"> <option disabled selected>Select Supplier</option> </select> </div></div><div class="col-md-4"> <div class="form-group"> <label for="">Quantity</label> <input type="number" class="form-control" name="quantity[]" id="quantity" aria-describedby="helpId" placeholder="Quantity"> </div></div><div class="col-md-4"> <label for="">Purchase Rate</label> <input type="text" class="form-control" name="purchase_rate[]" id="" aria-describedby="helpId" placeholder="purchase_rate"> </div><div class="col-md-4" style="text-align: center"> <button type="button" class="btn btn-danger" style="margin-top: 8%;" onclick="deletePurchase(' +
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
      $("#supplier_" + $element_id).empty();
      $("#product_" + $element_id).append(
        "<option disabled selected>Select Product</option>"
      );
      $("#supplier_" + $element_id).append(
        "<option disabled selected>Select Supplier</option>"
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
$("#purchase_product").on("change", ".product_class", function() {
  $element_id = $(this)
    .attr("id")
    .split("_")[1];
  $id = this.value;
  $.ajax({
    url: "http://localhost/oop-php-erp/helper/routing.php",
    method: "POST",
    data: { getSupplierByProductId: true, product_id: $id },
    dataType: "json",
    success: function(data) {
      $("#supplier_" + $element_id).empty();
      $("#supplier_" + $element_id).append(
        "<option disabled selected>Select Supplier</option>"
      );
      data.forEach(function(item, index) {
        $("#supplier_" + $element_id).append(
          "<option value='" + item.id + "'>" + item.name + "</option>"
        );
      });
    },
    error: function(error) {
      console.log(error);
    }
  });
});
