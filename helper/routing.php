<?php

require_once ("init.php");


if(isset($_POST['add_product'])){
    $di->get("Product")->addProduct($_POST);
    Util::redirect("manage-product");
}

// if(isset($_POST['register_button'])){
//     $email = $_POST['email'];
//     $password = $_POST['password_hash'];
//     $repeat_password = $_POST['repeat_password'];

//         $validator = new Validator($database, $errorHandler);
//         $validation = $validator->check($_POST, [
//             'email' => [
//                 'required' => true,
//                 'maxlength' => 200,
//                 'unique' => 'employees',
//                 'email' => true
//             ],
//             'password' => [
//                 'required' => true,
//                 'minlength' => 5
//             ]
//         ]);

//         if($validation->fails())
//         {
//             echo '<pre>', print_r($validation->errors()->all(), true), '</pre>';
//         }
//         else
//         {
//             //CODE TO BE EXECUTED IF THE VALIDATION HAS NO ERRORS
//             $hashed_password = $hash->make($password);
    
//             $data = ['block_no','street','city','pincode','state','country','state','country','town'];
//             $insertion_array = Util::createAssocArray($data,$_POST);
//             $database->insert('address', $insertion_array);

//             $address_id = $database->lastInsertedID();
//             $_POST['password_hash'] = $hashed_password;
//             $_POST['address_id'] = $address_id;

//             $data = ['first_name','last_name','email','password_hash','phone_no','gender','address_id'];
//             $insertion_array2 = Util::createAssocArray($data,$_POST);
//             $database->insert('employees', $insertion_array2);

//             Util::redirect("login");
//         }

    

// }

if(isset($_POST['deleteBtn'])){
    $di->get("Product")->deleteProduct($_POST);
    Util::redirect("manage-product");
}

if(isset($_POST['getDetails'])){
    $data = $di->get($_POST['table_name'])->readDataToEdit($_POST);
    echo json_encode($data);
}
