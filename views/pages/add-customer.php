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
                        <h1 class="h3 mb-0 text-gray-800">Customer</h1>
                        <a href="<?php echo BASEPAGES?>manage-customer.php"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-list-ul fa-sm text-white-75"></i> Manage Customer </a>
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
                                            Customer</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <?php if(isset($_POST['edit_customer'])){
                $customer = $di->get("Customer")->readDataToEdit($_POST['customer_id']);
            ?>
                                    <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
                                        <input type="hidden" name="csrf_token" id="csrf_token"
                                            value=<?php echo Session::getSession("csrf_token");?>>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="first_name">Customer First Name</label>
                                                        <input type="text" class="form-control" name="first_name" id=""
                                                            aria-describedby="helpId" placeholder="Customer First Name"
                                                            value=<?php echo $customer[0]['first_name'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="last_name">Customer Last Name</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="last_name" aria-describedby="helpId"
                                                            placeholder="Customer Last Name"
                                                            value=<?php echo $customer[0]['last_name'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gst_no">GST Number</label>
                                                        <input type="text" class="form-control" name="gst_no"
                                                            id="gst_no" aria-describedby="helpId"
                                                            placeholder="GST Number"
                                                            value=<?php echo $customer[0]['gst_no'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone_no">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_no"
                                                            id="phone_no" aria-describedby="helpId"
                                                            placeholder="Phone Number"
                                                            value=<?php echo $customer[0]['phone_no'] ?>>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="email_id">Email</label>
                                                        <input type="text" class="form-control" name="email_id"
                                                            id="email_id" aria-describedby="helpId" placeholder="Email"
                                                            value=<?php echo $customer[0]['email_id'] ?>> -->
                                                    <!-- </div> -->
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value=<?php echo $customer[0]['gender'] ?> hidden>
                                                                <?php echo $customer[0]['gender'] ?>
                                                            </option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="block_no">Block Number</label>
                                                        <input type="text" class="form-control" name="block_no"
                                                            id="block_no" aria-describedby="helpId"
                                                            placeholder="Block Number"
                                                            value=<?php echo $customer[0]['block_no'] ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="street">Street</label>
                                                        <input type="text" class="form-control" name="street"
                                                            id="street" aria-describedby="helpId" placeholder="Street"
                                                            value=<?php echo $customer[0]['street'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control" name="city" id="city"
                                                            aria-describedby="helpId" placeholder="City"
                                                            value=<?php echo $customer[0]['city'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pincode">Pincode</label>
                                                        <input type="text" class="form-control" name="pincode"
                                                            id="pincode" aria-describedby="helpId" placeholder="Pincode"
                                                            value=<?php echo $customer[0]['pincode'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <input type="text" class="form-control" name="state" id="state"
                                                            aria-describedby="helpId" placeholder="State"
                                                            value=<?php echo $customer[0]['state'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input type="text" class="form-control" name="country"
                                                            id="country" aria-describedby="helpId" placeholder="Country"
                                                            value=<?php echo $customer[0]['country'] ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="town">Town</label>
                                                        <input type="text" class="form-control" name="town" id="town"
                                                            aria-describedby="helpId" placeholder="Town"
                                                            value=<?php echo $customer[0]['town'] ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="address_id"
                                                value="<?php echo $customer[0]["address_id"] ?>">
                                            <input type="hidden" name="customer_id"
                                                value="<?php echo $customer[0]["customer_id"] ?>">
                                            <button type="submit" class="btn btn-primary" name="edit_customer">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                    <?php
                                    }else{
                                    ?>
                                    <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
                                        <input type="hidden" name="csrf_token" id="csrf_token"
                                            value=<?php echo Session::getSession("csrf_token");?>>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="first_name">Customer First Name</label>
                                                        <input type="text" class="form-control" name="first_name" id=""
                                                            aria-describedby="helpId" placeholder="Customer First Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="last_name">Customer Last Name</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="last_name" aria-describedby="helpId"
                                                            placeholder="Customer Last Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gst_no">GST Number</label>
                                                        <input type="text" class="form-control" name="gst_no"
                                                            id="gst_no" aria-describedby="helpId"
                                                            placeholder="GST Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone_no">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_no"
                                                            id="phone_no" aria-describedby="helpId"
                                                            placeholder="Phone Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email_id">Email</label>
                                                        <input type="text" class="form-control" name="email_id"
                                                            id="email_id" aria-describedby="helpId" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value="none" selected disabled hidden>
                                                                Select gender
                                                            </option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="block_no">Block Number</label>
                                                        <input type="text" class="form-control" name="block_no"
                                                            id="block_no" aria-describedby="helpId"
                                                            placeholder="Block Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="street">Street</label>
                                                        <input type="text" class="form-control" name="street"
                                                            id="street" aria-describedby="helpId" placeholder="Street">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" class="form-control" name="city" id="city"
                                                            aria-describedby="helpId" placeholder="City">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pincode">Pincode</label>
                                                        <input type="text" class="form-control" name="pincode"
                                                            id="pincode" aria-describedby="helpId"
                                                            placeholder="Pincode">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <input type="text" class="form-control" name="state" id="state"
                                                            aria-describedby="helpId" placeholder="State">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input type="text" class="form-control" name="country"
                                                            id="country" aria-describedby="helpId"
                                                            placeholder="Country">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="town">Town</label>
                                                        <input type="text" class="form-control" name="town" id="town"
                                                            aria-describedby="helpId" placeholder="Town">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary"
                                                name="add_customer">Submit</button>
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