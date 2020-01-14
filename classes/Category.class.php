<?php
  class Category{
    protected $db ;
    public function __construct(Database $db){
      $this->db = $db;
    }

  }
?>