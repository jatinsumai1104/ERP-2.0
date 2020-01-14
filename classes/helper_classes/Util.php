<?php

require_once(__DIR__.'/../../helper/constants.php');
class Util{

  public static function redirect($file){
    header("Location: ".BASEURL."views/pages/$file.php");
  }
}