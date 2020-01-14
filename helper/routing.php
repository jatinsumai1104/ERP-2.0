<?php

require_once ("init.php");


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