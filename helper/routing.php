<?php

require_once ("init.php");


if(isset($_POST['login_details'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
}

if(isset($_POST['add_product'])){
    $table = "products";
    $name = $_POST['name'];
    $specification = $_POST['specification'];
    $hsn_code = $_POST['hsn_code'];
    $selling_rate = $_POST['selling_rate'];
    $category_id = $_POST['category_id'];
    $eoq_level = $_POST['eoq_level'];
    $danger_level = $_POST['danger_level'];
    $quantity = $_POST['quantity'];
    $suppliers = $_POST['supplier_id'];
    $data = ["name","specification","hsn_code","sale_rate","category_id","eoq_level","danger_level","quantity"];
    $assoc_array = Util::createAssocArray($data,$_POST);
    $product_db = new Product($database);
    //echo print_r($assoc_array);
    //echo $product_db->call();
    // $data = ["name"=>$name,"specification"=>$specification,"hsn_code"=>$hsn_code,"category_id"=>$category_id,"eoq_level"=>$eoq_level,"danger_level"=>$danger_level,"quantity"=>$quantity];
    $res = $database->insert($table,$data);
    $product_id =  $database->lastInsertedID();
    $table="product_supplier";
    $_POST['product_id'] = $product_id;
    $data = ["product_id","supplier_id"];
    foreach($suppliers as $supplier_id){
        $assoc_array = Util::createAssocArray($data,$_POST);
        $res = $database->insert($table,$data);
    }
    $table="product_selling_rate";
    $data=["product_id","selling_rate"];
    $res = $database->insert($table,$data);
    echo "success";

}

if(isset($_POST['register_button'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $block_no = $_POST['block_no'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $town = $_POST['town'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    
}
if(isset($_POST['login_details'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(isset($_POST['remember'])){
        echo $_POST['remember'];
    }else{
        echo "not set";
    }
}

if(isset($_POST['deleteBtn'])){
    $database->delete($_POST['table'], "id = ".$_POST['id']);
    Util::redirect("manage-product");
}

if(isset($_POST['getDetails'])){
    echo json_encode($database->readData($_POST['table_name'], ["*"], "id = ".$_POST['id'])[0]);
}
