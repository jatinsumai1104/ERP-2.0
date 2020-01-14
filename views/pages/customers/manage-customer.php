<?php
require_once('../../../helper/constants.php');
require_once('../../../helper/init.php');
require_once('../../../classes/Customer.php');
$customer = new Customer($database);
$customer_details =  $customer->readAllCustomers();

?>
<!DOCTYPE html>
<html lang="en">

<!-- Header containing all Links -->
<?php
require_once('../../includes/header.php');
?>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <?php
    require_once('../../includes/sidebar.php');
  ?>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <?php
        require_once('../../includes/navbar.php');        
      ?>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800"> Manage Product</h1>
          <a href="<?echo BASEPAGES?>add-product.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list-ul fa-sm text-white-75"></i> Add Product </a>
        </div>

        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog"></i>  Manage Product</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="customer_list" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>First name</th>
                      <th>Last name</th>
                      <th>Gst number</th>
                      <th>Phone number</th>
                      <th>Email id</th>
                      <th>Gender</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    for($i=0;$i<count($customer_details);$i++){
                  ?>
                    <tr>
                      <td><?php echo $customer_details[$i]['first_name'];?></td>
                      <td><?php echo $customer_details[$i]['last_name'];?></td>
                      <td><?php echo $customer_details[$i]['gst_no'];?></td>
                      <td><?php echo $customer_details[$i]['phone_no'];?></td>
                      <td><?php echo $customer_details[$i]['email_id'];?></td>
                      <td><?php echo $customer_details[$i]['gender'];?></td>
                      <td><button type="button" id=<?php echo $customer_details[$i]['id'] ?> class="btn btn-primary btn-block edit"><i class="fas fa-pencil-alt"></i> Edit</button></td>
                      <td><button type="button" id=<?php echo $customer_details[$i]['id'] ?>  class="btn btn-danger btn-block delete"><i class="far fa-trash-alt"></i> Delete</button></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>

                    <!-- BEGIN EDIT MODAL -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- END OF EDIT MODAL -->
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
      require_once('../../includes/footer.php');
    ?>
    <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- All Required Scripts  -->
<?php
  require_once('../../includes/scripts.php');
?>
</body>

</html>