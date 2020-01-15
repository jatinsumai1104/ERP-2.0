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
    Util::redirect("login");
}

if(isset($_POST['deleteBtn'])){
    $di->get("Product")->deleteProduct($_POST);
    Util::redirect("manage-product");
}

if(isset($_POST['getDetails'])){
    $data = $di->get($_POST['table_name'])->readDataToEdit($_POST);
    echo json_encode($data);
}

if(isset($_POST["editBtn"])){
    $di->get("Product")->updateProduct($_POST);
    // Util::redirect("manage-product");
}

if(isset($_POST['add_supplier'])){

    $di->get("Supplier")->addSupplier($_POST);
    if(Session::getSession("supplier_add") == null){
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
