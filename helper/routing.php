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

    
    $hashed_password = $hash->make($password);

    $data = array('block_no'=>$block_no, 'street'=>$street,'city'=> $city, 'pincode' =>$pincode, 'state'=>$state, 'country'=>$country, 'town'=>$town);

    $database->table('address')->insert($data);
        

    $address_id=1;
    $data = array('first_name'=>$first_name,'last_name'=>$last_name, 'email_id'=> $email, 'password_hash'=>$password,'phone_no'=>$phone,'gender'=>$gender,'address_id'=>$address_id);
    print_r(array_keys($data));


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