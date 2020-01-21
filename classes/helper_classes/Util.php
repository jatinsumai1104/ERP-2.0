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
        return uniqid() . rand();
    }

    public static function createAssocArray($arrayOfKeys, $post)
    {
        $assoc_array;
        foreach ($arrayOfKeys as $key) {
            $assoc_array[$key] = $post[$key];
        }
        return $assoc_array;
    }

    public static function createToastr($status, $constant, $toastrDetails)
    {
        if (isset($_SESSION[$status]) && $_SESSION[$status] == $constant) {
            $script = '<script>
            toastr["success"]("'.$toastrDetails["message"].'","' . $toastrDetails["title"] . '")
          </script>';
            echo $script;
            unset($_SESSION[$status]);
        }
    }

}
