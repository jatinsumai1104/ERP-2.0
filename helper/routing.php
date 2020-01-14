<?php

require_once ("init.php");

if(isset($_POST['login_details'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
}