<?php
  class Supplier{
    protected $db ;
    public function __construct(Database $db){
      $this->db = $db;
    }

  }
?>