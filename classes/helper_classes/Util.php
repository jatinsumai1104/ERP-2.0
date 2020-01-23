<?php

require_once __DIR__ . '/../../helper/constants.php';
class Util
{

    public static function redirect($file)
    {
        header("Location: " . BASEURL . "views/pages/$file.php");
    }

    public static function createCsrfToken()
    {
        Session::setSession("csrf_token", uniqid() . rand());
        Session::setSession("token_expire", time() + 3600);
    }

    public static function createAssocArray($arrayOfKeys, $post)
    {
        $assoc_array;
        foreach ($arrayOfKeys as $key) {
            $assoc_array[$key] = $post[$key];
        }
        return $assoc_array;
    }

    public static function createToastr($status, $toastrDetails)
    {
        // echo $status;
        echo "<script>
            toastr['{$status}']( '{$toastrDetails["message"]}', '{$toastrDetails["title"]}' )
        </script>";
    }

    public static function verifyCSRF($data){
        return (isset($data['csrf_token']) && Session::getSession("csrf_token") != null && $data['csrf_token'] == Session::getSession("csrf_token") && Session::getSession("token_expire") > time());
    }
}
