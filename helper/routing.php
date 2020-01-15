<?php

require_once ("init.php");


if(isset($_POST['add_product'])){
    $di->get("Product")->addProduct($_POST);
    Util::redirect("manage-product");
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
