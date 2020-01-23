
<?php
require_once(__DIR__.'/../../helper/constants.php');
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
        

        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog"></i>  Manage Product</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Category Name</th>
                      <th>HSN Code</th>
                      <th>GST Rate</th>
                      <th>With Effect From</th>
                      <th>Supplier Name</th>
                      <th>Purchase Rate</th>
                      <th>Purchase Quantity</th>
                      <th>Purchase Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                      $purchase_logs = $di->get("Purchase")->getDataForDataTables($_SESSION['from_date'],$_SESSION['to_date']);
                    //   unset($_SESSION['from_date']);
                    //   unset($_SESSION['to-date']);
                    // print_r($purchase_logs);
                      foreach($purchase_logs as $log){
                    ?>
                    <tr>
                        <td><?php echo $log["product_name"]; ?></td>
                        <td><?php echo $log["category_name"]; ?></td>
                        <td><?php echo $log["hsn_code"]; ?></td>
                        <td><?php echo $log["gst_rate"]; ?></td>
                        <td><?php echo $log["with_effect_from"]; ?></td>
                        <td><?php echo $log["supplier_name"]; ?></td>
                        <td><?php echo $log["purchase_rate"]; ?></td>
                        <td><?php echo $log["quantity"]; ?></td>
                        <td><?php echo $log["purchased_on"]; ?></td>


                    </tr>
                      <?php 
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        <!-- Content Row -->

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

</body>

</html>