<?php
  class Product_Supplier{
    protected $db ;
    public function __construct(Database $db){
      $this->db = $db;
      $this->db->table($this->table);
    }

  }
?>