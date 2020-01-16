<?php

session_start();
unset($_SESSION['employee_id']);
if(isset($_COOKIE['token'])){
    unset($_COOKIE['token']);
    unset($_COOKIE['user_id']);
}
header("Location: login.php");

?>