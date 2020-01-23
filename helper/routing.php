<?php

require_once ("init.php");


if(isset($_POST['add_product'])){
    $di->get("Product")->addProduct($_POST);
    if(Session::getSession("product_add") == null){
        echo "Error";
    }else{
        Util::redirect("manage-product");
    }
}

if(isset($_POST['register_button'])){
    $di->get("Auth")->register($_POST);
    
}

if(isset($_POST['login_details'])){
    $di->get("Auth")->login($_POST);
}

if(isset($_POST['deleteBtn'])){
    if($_POST['table'] == "products"){
    $di->get("Product")->deleteProduct($_POST);
    Util::redirect("manage-product");
    }else if($_POST['table'] == "category"){
        $di->get("Database")->delete("category","id={$_POST['id']}");
    Util::redirect("manage-category");
    }
}

if(isset($_POST['getDetails'])){
    $data = $di->get($_POST['table_name'])->readDataToEdit($_POST);
    echo json_encode($data);
}

if(isset($_POST["editBtn"])){
    if($_POST['class_name'] == "Product"){
    $di->get("Product")->updateProduct($_POST);
    if(Session::getSession("product_edit") != null && Session::getSession("product_edit") === "success"){
        Util::redirect("manage-product");
    }else{
        echo "Error while Updating";
    }
    }else if($_POST['class_name'] == "Category"){
    $di->get("Category")->updateCategory($_POST);
    if(Session::getSession("category_edit") != null && Session::getSession("category_edit") === "success"){
        Util::redirect("manage-category");
    }else{
        echo "Error while Updating";
    }
}
    
}

if(isset($_POST['add_supplier'])){

    $di->get("Supplier")->addSupplier($_POST);
    if(Session::getSession("supplier_add") == null){
        echo "Error";
    }else{
        Util::redirect("manage-supplier");
    }
    
}

if(isset($_POST['edit_supplier'])){

    $di->get("Supplier")->updateSupplier($_POST);
    if(Session::getSession("supplier_edit") == null){
        echo "Error";
    }else{
        Util::redirect("manage-supplier");
    }
    
}
if(isset($_POST['add_category'])){

    $di->get("Category")->addCategory($_POST);
    if(Session::getSession("category_add") == null){
        echo "Error";
    }else{
        Util::redirect("manage-category");
    }
    
}

if(isset($_POST["getProductByCategoryId"])){
    echo json_encode($di->get("Database")->readData("products",["id", "name"], "category_id = {$_POST['category_id']}"));
}

if(isset($_POST["getSupplierByProductId"])){
    echo json_encode($di->get("Supplier")->getSupplierByProductId($_POST));
}

if(isset($_POST["getCategories"])){
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
    if(Session::getSession("add") == null){
        echo "Error";
    }else{
        Util::redirect("add-purchase");
    }
}

if(isset($_POST['purchase_report'])){
    echo $_POST['from'];
    echo $_POST['to'];
}