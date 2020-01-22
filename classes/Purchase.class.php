<?php
require_once(__DIR__."/../helper/requirements.php");
class Purchase{
  private $table = "purchase";
  protected $di ;
  public function __construct($di){
    $this->di = $di;
  }

  
}
?>