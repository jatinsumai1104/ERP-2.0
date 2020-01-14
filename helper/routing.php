<?php

require_once ("init.php");


if(isset($_POST['login_details'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
}

if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $product_specification = $_POST['product_specification'];
    $hsn_code = $_POST['hsn_code'];
    $sale_rate = $_POST['sale_rate'];
    $category_id = $_POST['category_id'];
    $eoq_level = $_POST['eoq_level'];
    $danger_level = $_POST['danger_level'];
    $quantity = $_POST['quantity'];
    
    $product_db = new Product($database);
    echo $product_db->call();
    $data=
    $database->
}
?>