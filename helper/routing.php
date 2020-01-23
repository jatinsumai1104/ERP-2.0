<?php

require_once "init.php";

//Add Routings
if (isset($_POST['add_product'])) {
    if (Util::verifyCSRF($_POST) && isset($_POST['supplier_id'])) {
        $di->get("Product")->addProduct($_POST);
        Util::redirect("manage-product");
    }else{
        Session::setSession("csrf", "CSRF error");
        Util::redirect("login");
    }
}
if (isset($_POST['add_supplier'])) {
    if (Util::verifyCSRF($_POST)) {
        $di->get("Supplier")->addSupplier($_POST);
        Util::redirect("manage-supplier");
    }else{
        Session::setSession("csrf", "CSRF error");
        Util::redirect("login");
    }
}

if (isset($_POST['add_customer'])) {
    if (Util::verifyCSRF($_POST)) {
        $di->get("Customer")->addCustomer($_POST);
        Util::redirect("add-customer");
        echo "Error while adding customer";
    }else{
        Session::setSession("csrf", "CSRF error");
        Util::redirect("login");
    }
}
if (isset($_POST['add_category'])) {
    if (Util::verifyCSRF($_POST)) {
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
        Util::redirect("manage-category");
    }else{
        Session::setSession("csrf", "CSRF error");
        Util::redirect("login");
    }
}
if (isset($_POST['add_purchase'])){
    if(Util::verifyCSRF($_POST)){
        $di->get("Purchase")->addPurchase($_POST);
        Util::redirect("add-purchase");
    }else{
        Session::setSession("csrf", "CSRF error");
        Util::redirect("login");
    }
}

//Edit Routings
if(isset($_POST["editBtn"])){
    if (Util::verifyCSRF($_POST)) {
        $di->get($_POST["class_name"])->update($_POST);
        Util::redirect("manage-".strtolower($_POST["class_name"]));
    }else{
        Session::setSession("csrf", "CSRF error");
        var_dump($_SESSION);
        // Util::redirect("login");
    }
}

//Delete Routings
if(isset($_POST['deleteBtn'])){
    $di->get($_POST["class_name"])->delete($_POST);
    Util::redirect("manage-".strtolower($_POST["class_name"]));
}

//Auth Routings
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

if (isset($_POST['logout'])){
    Session::destroySession();
    if(isset($_COOKIE['token'])){
        unset($_COOKIE['token']);
        unset($_COOKIE['user_id']);
    }
    Util::redirect("login");
}

//Getting Data for Edit Modal Routes

if(isset($_POST['getDetails'])){
    $data = $di->get($_POST['class_name'])->readDataToEdit($_POST);
    echo json_encode($data);
}

if (isset($_POST["getProductByCategoryId"])) {
    echo json_encode($di->get("Database")->readData("products", ["id", "name"], "category_id = {$_POST['category_id']}"));
}
//Anonymous Routings
if(isset($_POST["getProductByCategoryId"])){
    echo json_encode($di->get("Database")->readData("products",["id", "name"], "category_id = {$_POST['category_id']}"));
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

