
<?php
require_once('../../helper/constants.php');
require_once(__DIR__.'/../../helper/init.php');
?>
<!DOCTYPE html>
<html lang="en">

<!-- Header containing all Links -->
<?php
require_once('../includes/header.php');
?>
<style>
.email-verify{
  background-color: green;
  color: #fff;
  padding: 6px 8px;
  font-size: .875rem;
  line-height: 1.5;
  border-radius: .2rem;
  vertical-align: middle;
  display:none;
}
.bg-red{
  background-color: red;
}
</style>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <?php
    require_once('../includes/sidebar.php');
  ?>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <?php
        require_once('../includes/navbar.php');
      ?>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Sales</h1>
        </div>

        <!-- Content Row -->
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Customer Email Verification -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <div>
                <!-- <label for="">Check Customer Email</label> -->
                <input type="text"
                  class="form-control" name="email" id="customer_email" aria-describedby="helpId" placeholder="Email of Customer.." style="width:160%">
              </div>
              <div>
                <p class="email-verify" id="email_verified_success"><i class="fas fa-check fa-sm text-white-75 mr-1"></i>Email Verified</p>
                <p class="email-verify bg-red" id="email_verified_fail"><i class="fas fa-times fa-sm text-white-75 mr-1"></i>Email Not Verified</p>
                <a href="<?php echo BASEPAGES?>manage-product.php" class="btn btn-sm btn-warning shadow-sm" id="add_customer" style="display:none;"><i class="fas fa-users fa-sm text-white-75"></i> Add Customer </a>
                <button type="button" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="check_email" id="check_email"><i class="fas fa-envelope fa-sm text-white-75"></i> Check Email</button>
              </div>
            </div>
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus"></i> Sales</h6>
              <button type="button" onclick="addPurchase();" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-75"></i> Add One More Element</button>
            </div>
            
            <!-- Card Body -->
            <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
              <input type="hidden" name="customer_id" id="customer_id">
              <input type="hidden" name="csrf_token" id="csrf_token" value=<?php echo Session::getSession("csrf_token"); ?>>
              <div class="card-body">
                <div id="purchase_product">
                  <div class="row" id="element_1">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="category_1" class="form-control category_class">
                        <option disabled selected>Select Category</option>
                          <?php
                            $res = $di->get("Database")->readData("category",["id","name"],"deleted=0");
                            foreach($res as $arr){
                              echo "<option value={$arr['id']}>{$arr['name']}</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Product</label>
                        <select name="product_id[]" id="product_1" class="form-control product_class">
                          <option disabled selected>Select Product</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number"
                          class="form-control" name="quantity[]" id="quantity" aria-describedby="helpId" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Discount</label>
                        <input type="number"
                          class="form-control" name="discount[]" id="discount" aria-describedby="helpId" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4" style="text-align: center">
                      <button type="button" class="btn btn-danger" style="margin-top: 8%;" onclick="deletePurchase(1)">
                        <i class="far fa-trash-alt"></i> Delete Element
                      </button>
                    </div>
                  </div>
                </div>
                <hr>
                <div id="get_total_price_div">
                  <div class="row">
                    <div class="col-md-4"><button type="button" class="btn btn-primary" id="get_total_amount">Get Total Price</button></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h3 class="product_class" placeholder="Total Price">Total Price:  <span id="total_price">______</span></h3>
                        <input type="text" name="amount" id="total_price_input" hidden>
                    </div>
                  </div>
                </div>
                <hr>
                <div id="payment_mode_div">
                  <div class="form-group">
                    <label for="">Payment Mode</label>
                    <select name="pay_mode" id="payment_mode" class="form-control">
                      <option disabled selected>Select Payment mode</option>
                      <option value="cash">Cash</option>
                      <option value="cheque">Cheque</option>
                    </select>
                  </div>
                </div>
                <div id="payment-div">
                </div>
              </div>
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <button type="submit" class="btn btn-primary" name="add_sales">Submit</button>
              </div>
            </form>
          </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php
      require_once('../includes/footer.php');
    ?>
    <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- All Required Scripts  -->
<?php
  require_once('../includes/scripts.php');
?>

<script src="<?php echo BASEASSETS;?>js/sales.js"></script>

</body>

</html>