<?php

require_once "init.php";

if (isset($_POST['add_product'])) {

    if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
        if (isset($_POST['supplier_id'])) {
            $di->get("Product")->addProduct($_POST);
            if (Session::getSession("product_add") == "fail") {
                echo "Error";
            } else {
                Util::redirect("manage-product");
            }
        }
    }

}

if (isset($_POST['add_supplier'])) {
    if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
        $di->get("Supplier")->addSupplier($_POST);
        if (Session::getSession("supplier_add") == "fail") {
            echo "Error";
        } else {
            Util::redirect("manage-supplier");
        }
    }
}

if (isset($_POST['add_customer'])) {
    if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
        $di->get("Customer")->addCustomer($_POST);
        if (Session::getSession("customer_add") == "fail") {
            echo "Error";
        } else {
            Util::redirect("add-customer");
        }
    }
}

if (isset($_POST['add_category'])) {

    if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
        $di->get("Category")->addCategory($_POST);
        if (Session::getSession("category_add") == "fail") {
            echo "Error";
        } else {
            Util::redirect("manage-category");
        }
    }
}

if (isset($_POST["editBtn"])) {
    $di->get("Product")->updateProduct($_POST);
    if (Session::getSession("product_edit") != null && Session::getSession("product_edit") === "success") {
        Util::redirect("manage-product");
    } else {
        echo "Error while Updating";
    }

}

if (isset($_POST['getDetails'])) {
    $data = $di->get($_POST['table_name'])->readDataToEdit($_POST);
    echo json_encode($data);
}

if (isset($_POST['edit_supplier'])) {
    if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
        $di->get("Supplier")->updateSupplier($_POST);
        if (Session::getSession("supplier_edit") == null) {
            echo "Error";
        } else {
            Util::redirect("manage-supplier");
        }
    }
}

if (isset($_POST["edit_customer"])) {
    if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
        $di->get("Customer")->updateCustomer($_POST);
        if (Session::getSession("customer_edit") != null && Session::getSession("customer_edit") === "success") {
            Util::redirect("manage-customer");
        } else {
            echo "Error while Insertion";
        }
    }
}

if (isset($_POST['deleteBtn'])) {
    $di->get("Product")->deleteProduct($_POST);
    Util::redirect("manage-product");
}

if (isset($_POST['deleteSupplierBtn'])) {
    $di->get("Supplier")->deleteSupplier($_POST);
    Util::redirect("manage-supplier");
}

if (isset($_POST['deleteCustomerBtn'])) {
    $di->get("Customer")->deleteCustomer($_POST);
    Util::redirect("manage-customer");
}

if (isset($_POST['login_details'])) {
    if (isset($_POST['csrf_token']) && isset($_SESSION["csrf_token"]) && $_POST['csrf_token'] == Session::getSession("csrf_token")) {
        $di->get("Auth")->login($_POST);
    } else {
        Util::redirect("login");
    }
}

if (isset($_POST['register_button'])) {
    $di->get("Auth")->register($_POST);

}
