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
                        <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
                        <a href="<?echo BASEPAGES?>manage-Supplier.php"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-list-ul fa-sm text-white-75"></i> Manage Supplier </a>
                    </div>

                    <!-- Content Row -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus"></i> Add
                                            Supplier</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <?php if(isset($_POST['edit_supplier'])){
                $supplier = $di->get("Supplier")->readDataToEdit($_POST['supplier_id']);
              ?>
                                    <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
                                        <input type="hidden" name="csrf_token" id="csrf_token"
                                            value=<?php echo Session::getSession("csrf_token");?>>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Supplier First Name</label>
                                                        <input type="text" class="form-control" name="first_name" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['first_name']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Supplier Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['last_name']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">GST Number</label>
                                                        <input type="text" class="form-control" name="gst_no" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['gst_no']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_no" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['phone_no']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">City</label>
                                                        <input type="text" class="form-control" name="city" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['city']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Pincode</label>
                                                        <input type="text" class="form-control" name="pincode" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['pincode']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">State</label>
                                                        <input type="text" class="form-control" name="state" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['state']; ?>">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="text" class="form-control" name="email_id" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['email_id']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Company Name</label>
                                                        <input type="text" class="form-control" name="company_name"
                                                            id="" aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['company_name']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Block Number</label>
                                                        <input type="text" class="form-control" name="block_no" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['block_no']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Street</label>
                                                        <input type="text" class="form-control" name="street" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['street']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Country</label>
                                                        <input type="text" class="form-control" name="country" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['country']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Town</label>
                                                        <input type="text" class="form-control" name="town" id=""
                                                            aria-describedby="helpId" placeholder=""
                                                            value="<?php echo $supplier[0]['town']; ?>">
                                                    </div>
                                                    <input type="hidden" name="address_id"
                                                        value="<?php echo $supplier[0]["address_id"] ?>">
                                                    <input type="hidden" name="supplier_id"
                                                        value="<?php echo $supplier[0]["supplier_id"] ?>">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="edit_supplier">Save
                                                Changes</button>
                                        </div>
                                    </form>

                                    <?php
             } else{
            ?>
                                    <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
                                        <input type="hidden" name="csrf_token" id="csrf_token"
                                            value=<?php echo Session::getSession("csrf_token");?>>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Supplier First Name</label>
                                                        <input type="text" class="form-control" name="first_name" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Supplier Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">GST Number</label>
                                                        <input type="text" class="form-control" name="gst_no" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_no" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">City</label>
                                                        <input type="text" class="form-control" name="city" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Pincode</label>
                                                        <input type="text" class="form-control" name="pincode" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">State</label>
                                                        <input type="text" class="form-control" name="state" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="text" class="form-control" name="email_id" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Company Name</label>
                                                        <input type="text" class="form-control" name="company_name"
                                                            id="" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Block Number</label>
                                                        <input type="text" class="form-control" name="block_no" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Street</label>
                                                        <input type="text" class="form-control" name="street" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Country</label>
                                                        <input type="text" class="form-control" name="country" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Town</label>
                                                        <input type="text" class="form-control" name="town" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>

                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary"
                                                name="add_supplier">Submit</button>
                                        </div>
                                    </form>
                                    <?php
            }
            ?>
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