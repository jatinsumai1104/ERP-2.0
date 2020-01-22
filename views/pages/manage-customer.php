<?php
require_once __DIR__ . '../../../helper/constants.php';
require_once __DIR__ . '../../../helper/init.php';
$customer_details = $di->get("Customer")->getDataForDataTables();

?>
<!DOCTYPE html>
<html lang="en">

<!-- Header containing all Links -->
<?php
require_once '../includes/header.php';
?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
require_once '../includes/sidebar.php';
?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
require_once '../includes/navbar.php';
?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Manage Customer</h1>
                        <a href="<?php echo BASEPAGES ?>add-customer.php"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-list-ul fa-sm text-white-75"></i> Add Customer </a>
                    </div>

                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog"></i> Manage Customer
                            </h6>
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
                                            <th>Address</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
for ($i = 0; $i < count($customer_details); $i++) {
    ?>
                                        <tr>
                                            <form action="<?php echo BASEPAGES ?>add-customer.php" method="POST">
                                                <td><?php echo $customer_details[$i]['first_name']; ?></td>
                                                <td><?php echo $customer_details[$i]['last_name']; ?></td>
                                                <td><?php echo $customer_details[$i]['gst_no']; ?></td>
                                                <td><?php echo $customer_details[$i]['phone_no']; ?></td>
                                                <td><?php echo $customer_details[$i]['email_id']; ?></td>
                                                <td><?php echo $customer_details[$i]['gender']; ?></td>
                                                <td><?php echo $customer_details[$i]["address_of_customer"] ?></td>
                                                <td><button type="submit" class="btn btn-primary btn-block"
                                                        name="edit_customer"><i class="fas fa-pencil-alt"></i>
                                                        Edit</button></td>
                                                <td><a type="button" class="btn btn-danger btn-block delete"
                                                        id=<?php echo $customer_details[$i]['customer_id'] ?> href="#"
                                                        data-toggle="modal" data-target="#deleteModal" class_name="Customer"><i
                                                            class="far fa-trash-alt"></i> Delete</a></td>
                                                <input type="hidden" name="customer_id"
                                                    value="<?php echo $customer_details[$i]['customer_id']; ?>">
                                            </form>
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
require_once '../includes/footer.php';
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
require_once '../includes/scripts.php';

?>
</body>

</html>