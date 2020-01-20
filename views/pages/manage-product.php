
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
          <h1 class="h3 mb-0 text-gray-800"> Manage Product</h1>
          <a href="<?php echo BASEPAGES?>add-product.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list-ul fa-sm text-white-75"></i> Add Product </a>
        </div>

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
                      <th>Specification</th>
                      <th>Selling Rate</th>
                      <th>With Effect From</th>
                      <th>EOQ Level</th>
                      <th>Danger Level</th>
                      <th>Category Name</th>
                      <th>Supplier Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $products = $di->get("Product")->getDataForDataTables();
                      foreach($products as $product){
                    ?>
                    <tr>
                      <td><?php echo $product["product_name"];?></td>
                      <td><?php echo $product["specification"]?></td>
                      <td><?php echo $product["selling_rate"]?></td>
                      <td><?php echo $product["wef"]?></td>
                      <td><?php echo $product["eoq_level"]?></td>
                      <td><?php echo $product["danger_level"]?></td>
                      <td><?php echo $product["category_name"]?></td>
                      <td><?php echo $product["supplier_name"]?></td>
                      <td><a type="button" class="btn btn-primary btn-block edit" id="<?php echo $product["product_id"]?>" href="#" data-toggle="modal" data-target="#editModal" table_name="Product"><i class="fas fa-pencil-alt" ></i> Edit</a></td>
                      <td><a type="button" class="btn btn-danger btn-block delete" id="<?php echo $product["product_id"]?>" href="#" data-toggle="modal" data-target="#deleteModal"><i class="far fa-trash-alt"></i> Delete</a></td>
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
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Edit?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="product_id" id="editId">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="name" class="col-sm-2 col-form-label" style="max-width: 100%">Product Name</label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="name" name="name">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="specification" class="col-sm-2 col-form-label" style="max-width: 100%">Specification</label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="specification" name="specification">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <input type="hidden" name="old_selling_rate" id="old_selling_rate">
                  <label for="selling_rate" class="col-sm-2 col-form-label" style="max-width: 100%">Selling Rate</label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="selling_rate" name="selling_rate">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="wef" class="col-sm-2 col-form-label" style="max-width: 100%">With Effect From</label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="wef" name="wef" disabled>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="eoq_level" class="col-sm-2 col-form-label" style="max-width: 100%">EOQ Level</label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="eoq_level" name="eoq_level">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="danger_level" class="col-sm-2 col-form-label" style="max-width: 100%">Danger Level</label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="danger_level" name="danger_level">
                </div>
              </div>
            
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" type="submit" name="editBtn">Confirm Edit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
  <!-- End of Delete Modal -->
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to delete?</div>
        <div class="modal-footer">
          <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
            <input type="hidden" name="table" value="products">
            <input type="hidden" name="id" id="recordId">
            <button class="btn btn-danger" type="submit"  name="deleteBtn">Yes</button>
          </form>
          <a class="btn btn-success" href="#" data-dismiss="modal">No</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Delete Modal -->
<!-- All Required Scripts  -->
<?php
  require_once('../includes/scripts.php');
?>

</body>

</html>