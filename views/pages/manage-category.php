
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
          <h1 class="h3 mb-0 text-gray-800"> Manage Category</h1>
          <a href="<?php echo BASEPAGES?>add-category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list-ul fa-sm text-white-75"></i> Add Category </a>
        </div>

        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog"></i>  Manage Ctageory</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $categories = $di->get("Database")->readData("category",["*"],"deleted=0");
                      foreach($categories as $category){
                    ?>
                    <tr>
                      <td><?php echo $category["name"];?></td>
                      <td><a type="button" class="btn btn-primary btn-block edit" id="<?php echo $category["id"]?>" href="#" data-toggle="modal" data-target="#editModal" class_name="Category"><i class="fas fa-pencil-alt" ></i> Edit</a></td>
                      <td><a type="button" class="btn btn-danger btn-block delete" id="<?php echo $category["id"]?>" href="#" data-toggle="modal" data-target="#deleteModal" class_name="Category"><i class="far fa-trash-alt"></i> Delete</a></td>
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
              <input type="hidden" name="csrf_token" id="csrf_token" value=<?php echo Session::getSession("csrf_token"); ?>>
              <input type="hidden" name="category_id" id="editId">
              <input type="hidden" name="class_name" id="edit_class_name">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="name" class="col-sm-2 col-form-label" style="max-width: 100%">Category Name</label>
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="name" name="name">
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