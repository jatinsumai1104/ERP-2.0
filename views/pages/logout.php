<?php

session_start();
Session::destroySession();
if(isset($_COOKIE['token'])){
    unset($_COOKIE['token']);
    unset($_COOKIE['user_id']);
}
header("Location: login.php");

?>