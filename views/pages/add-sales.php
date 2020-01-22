
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
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus"></i> Sales</h6>
              <button type="button" onclick="addPurchase();" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-75"></i> Add One More Element</button>
            </div>
            <!-- Card Body -->
            <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
              <div class="card-body">
                <div id="purchase_product">
                  <div class="row" id="element_1">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="category_1" class="form-control category_class">
                        <option disabled selected>Select Category</option>
                          
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Product</label>
                        <select name="product_id" id="product_1" class="form-control product_class">
                          <option disabled selected>Select Product</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number"
                          class="form-control" name="quantity" id="quantity" aria-describedby="helpId" placeholder="">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Discount</label>
                        <input type="number"
                          class="form-control" name="discount" id="discount" aria-describedby="helpId" placeholder="">
                      </div>
                    </div>
                    
                    <div class="col-md-4" style="text-align: center">
                      <button type="button" class="btn btn-danger" id="1" style="margin-top: 8%;" onclick="deletePurchase(1)">
                        <i class="far fa-trash-alt"></i> Delete Element
                      </button>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <button type="submit" class="btn btn-primary" name="add_product">Submit</button>
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