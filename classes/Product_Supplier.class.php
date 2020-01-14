<?php
  class Product_Supplier{
    protected $db ;
    protected $table = "product_supplier";
    public function __construct(Database $db){
      $this->db = $db;
      $this->db->table($this->table);
    }

  }
?>