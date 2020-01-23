
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
          <h1 class="h3 mb-0 text-gray-800">Category</h1>
          <a href="<?php echo BASEPAGES?>manage-category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list-ul fa-sm text-white-75"></i> Manage Supplier </a>
        </div>

        <!-- Content Row -->
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus"></i> Add Category</h6>
            </div>
            <!-- Card Body -->
            <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
              <div class="card-body">
                <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">name</label>
                      <input type="text"
                        class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" name="add_category">Submit</button>
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

</body>

</html>