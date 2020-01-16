<?php
require_once(__DIR__.'../../../helper/constants.php');
require_once(__DIR__.'../../../helper/init.php');
$customer_details =  $di->get("Customer")->readAllCustomers();

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
          <h1 class="h3 mb-0 text-gray-800"> Manage Customer</h1>
          <a href="<?php echo BASEPAGES?>add-customer.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list-ul fa-sm text-white-75"></i> Add Customer </a>
        </div>

        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog"></i>  Manage Customer</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                      <td><a type="button" class="btn btn-primary btn-block edit" table_name="Customer" id=<?php echo $customer_details[$i]['id']?> href="#" data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt" ></i> Edit</a></td>
                      <td><a type="button" class="btn btn-danger btn-block delete" id=<?php echo $customer_details[$i]['id']?> href="#" data-toggle="modal" data-target="#deleteModal"><i class="far fa-trash-alt"></i> Delete</a></td>
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
        <div class="modal-body">
          <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
            <input type="hidden" name="customer_id" id="editId">
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="first_name" class="col-sm-2 col-form-label" style="max-width: 100%">First Name</label>
              </div>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="first_name" name="first_name">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="last_name" class="col-sm-2 col-form-label" style="max-width: 100%">Last Name</label>
              </div>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="last_name" name="last_name">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="gst_no" class="col-sm-2 col-form-label" style="max-width: 100%">Gst No.</label>
              </div>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="gst_no" name="gst_no" disabled>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="phone_no" class="col-sm-2 col-form-label" style="max-width: 100%">Phone Number</label>
              </div>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="phone_no" name="phone_no">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="email_id" class="col-sm-2 col-form-label" style="max-width: 100%">Email id</label>
              </div>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="email_id" name="email_id">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="gender" class="col-sm-2 col-form-label" style="max-width: 100%">Gender</label>
              </div>
              <div class="col-sm-7">
                <select name="gender" id="gender" class="form-control">
                    <!-- <option value=""></option> -->
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>    
                <!-- <input type="text" class="form-control" id="gender" name="gender"> -->
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-success" type="submit" name="editBtnCustomer">Confirm Edit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of edit Modal -->
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
            <input type="hidden" name="table" value="customers">
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