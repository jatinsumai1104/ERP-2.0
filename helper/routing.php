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
        if (Session::getSession("status") != null && Session::getSession("status") === CUSTOMER_ADD_SUCCESS) {
            Util::redirect("add-customer");
        } else {
            echo "Error while adding customer";
        }
    }
}
if (isset($_POST['deleteBtn'])) {
    if ($_POST['table'] == "products") {
        $di->get("Product")->deleteProduct($_POST);
        Util::redirect("manage-product");
    } else if ($_POST['table'] == "category") {
        $di->get("Database")->delete("category", "id={$_POST['id']}");
        Util::redirect("manage-category");
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
    if ($_POST['class_name'] == "Product") {
        $di->get("Product")->updateProduct($_POST);
        if (Session::getSession("product_edit") != null && Session::getSession("product_edit") === "success") {
            Util::redirect("manage-product");
        } else {
            echo "Error while Updating";
        }

    } else if ($_POST['class_name'] == "Category") {
        $di->get("Category")->updateCategory($_POST);
        if (Session::getSession("category_edit") != null && Session::getSession("category_edit") === "success") {
            Util::redirect("manage-category");
        } else {
            echo "Error while Updating";
        }
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
        if (Session::getSession("status") != null && Session::getSession("status") === CUSTOMER_EDIT_SUCCESS) {
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
    if (Session::getSession("status") != null && Session::getSession("status") === CUSTOMER_DELETE_SUCCESS) {
        Util::redirect("manage-customer");
    } else {
        echo "Error while Deleting";
    }
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

if (isset($_POST["getProductByCategoryId"])) {
    echo json_encode($di->get("Database")->readData("products", ["id", "name"], "category_id = {$_POST['category_id']}"));
}

if (isset($_POST["getSupplierByProductId"])) {
    echo json_encode($di->get("Supplier")->getSupplierByProductId($_POST));
}

if (isset($_POST["getCategories"])) {
    echo json_encode($di->get("Category")->getAllCategories());
}

if(isset($_POST["checkEmailOfCustomer"])){
    echo json_encode($di->get("Customer")->checkCustomerExist($_POST)[0]);
}

if(isset($_POST["add_sales"])){
    $di->get("Sale")->addProducts($_POST);
    if(Session::getSession("sales_add") == null){
        echo "Error";
    }else{
        Util::redirect("manage-sales");
    }
}
if(isset($_POST["get_total_amount"])){
    echo json_encode($di->get("Sale")->getTotalRate($_POST));
}

if(isset($_POST['add_purchase'])){
    $di->get("Purchase")->addPurchase($_POST);
    if (Session::getSession("add") == null) {
        echo "Error";
    } else {
        Util::redirect("add-purchase");
    }
}
