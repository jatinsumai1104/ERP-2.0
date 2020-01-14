<?php
  class Product{
    protected $db ;
    public function __construct(Database $db){
      $this->db = $db;
      $this->db->table($this->table);
    }


    public function getDataForDataTables(){
      $query = "SELECT p.id as product_id, p.name as product_name, p.specification, psr.selling_rate, p.eoq_level, p.danger_level,cat.name, GROUP_CONCAT(CONCAT(s.first_name,' ', s.last_name)) as supplier_name from products as p INNER JOIN product_supplier as ps ON p.id = ps.product_id INNER JOIN suppliers as s ON ps.supplier_id = s.id INNER JOIN category as cat ON p.category_id = cat.id INNER JOIN products_selling_rate as psr ON p.id = psr.product_id GROUP BY p.id ORDER BY p.id ASC";
      
      $res = $this->db->fetchAll($query);
    }

    public function call(){
      return "hii";
    }
  }
?>