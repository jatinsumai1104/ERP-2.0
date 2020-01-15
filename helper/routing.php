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
    $data = ["name","specification","hsn_code","category_id","eoq_level","danger_level","quantity"];
    $assoc_array = Util::createAssocArray($data,$_POST);
    // print_r($assoc_array);
    $product_db = new Product($database);
    //echo print_r($assoc_array);
    //echo $product_db->call();
    // $data = ["name"=>$name,"specification"=>$specification,"hsn_code"=>$hsn_code,"category_id"=>$category_id,"eoq_level"=>$eoq_level,"danger_level"=>$danger_level,"quantity"=>$quantity];
    $res = $database->insert($table,$assoc_array);
    $product_id =  $database->lastInsertedID();
    $table="product_supplier";
    $_POST['product_id'] = $product_id;
    $data = ["product_id","supplier_id"];
    foreach($suppliers as $supplier_id){
        $assoc_array = Util::createAssocArray($data,$_POST);
        $res = $database->insert($table,$assoc_array);
    }

    $table="products_selling_rate";
    $data=["product_id","selling_rate"];
    $assoc_array = Util::createAssocArray($data,$_POST);
    $res = $database->insert($table,$assoc_array);
    echo "success";

}

if(isset($_POST['register_button'])){
    $email = $_POST['email'];
    $password = $_POST['password_hash'];
    $repeat_password = $_POST['repeat_password'];

        $validator = new Validator($database, $errorHandler);
        $validation = $validator->check($_POST, [
            'email' => [
                'required' => true,
                'maxlength' => 200,
                'unique' => 'employees',
                'email' => true
            ],
            'password' => [
                'required' => true,
                'minlength' => 5
            ]
        ]);

        if($validation->fails())
        {
            echo '<pre>', print_r($validation->errors()->all(), true), '</pre>';
        }
        else
        {
            //CODE TO BE EXECUTED IF THE VALIDATION HAS NO ERRORS
            $hashed_password = $hash->make($password);
    
            $data = ['block_no','street','city','pincode','state','country','state','country','town'];
            $insertion_array = Util::createAssocArray($data,$_POST);
            $database->insert('address', $insertion_array);

            $address_id = $database->lastInsertedID();
            $_POST['password_hash'] = $hashed_password;
            $_POST['address_id'] = $address_id;

            $data = ['first_name','last_name','email','password_hash','phone_no','gender','address_id'];
            $insertion_array2 = Util::createAssocArray($data,$_POST);
            $database->insert('employees', $insertion_array2);

            Util::redirect("login");
        }

    

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
    $data = $database->readData($_POST['table_name'], ["*"], "id = ".$_POST['id'])[0];
    $data["selling_rate"] = $product->getSellingRate($_POST['id'])[0]["selling_rate"];
    echo json_encode($data);
}
