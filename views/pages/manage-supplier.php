
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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800"> Manage Supplier</h1>
          <a href="<?php echo BASEPAGES?>add-supplier.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list-ul fa-sm text-white-75"></i> Add Product </a>
        </div>

        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog"></i>  Manage Supplier</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Gst Number</th>
                      <th>Phone Number</th>
                      <th>Email</th>
                      <th>Company Name</th>
                      <th>Address</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $suppliers = $di->get("Supplier")->getDataForDataTables();
                      //print_r($suppliers);
                      foreach($suppliers as $supplier){
                    ?>
                    
                    <tr>
                    <form action="<?php echo BASEPAGES?>add-supplier.php" method="POST">
                      <td><?php echo $supplier["first_name"];?></td>
                      <td><?php echo $supplier["last_name"]?></td>
                      <td><?php echo $supplier["gst_no"]?></td>
                      <td><?php echo $supplier["phone_no"]?></td>
                      <td><?php echo $supplier["email_id"]?></td>
                      <td><?php echo $supplier["company_name"]?></td>
                      <td><?php echo $supplier["address_of_supplier"]?></td>
                      <td><button type="submit" class="btn btn-primary btn-block" name="edit_supplier" ><i class="fas fa-pencil-alt" ></i> Edit</button></td>
                      <td><a type="button" class="btn btn-danger btn-block delete" id="<?php echo $supplier["supplier_id"]?>" href="#" data-toggle="modal" data-target="#deleteModal" class_name="Supplier"><i class="far fa-trash-alt"></i> Delete</a></td>
                      <input type="hidden" name="supplier_id" value="<?php echo $supplier["supplier_id"] ?>">
                      </form>
                    </tr>
                    

                      <?php }?>
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
<!-- Delete Modal -->
<?php
  require_once('../includes/delete-modal.php');
?>
  <!-- End of Delete Modal -->
<!-- All Required Scripts  -->
<?php
  require_once('../includes/scripts.php');
?>

</body>

</html>
