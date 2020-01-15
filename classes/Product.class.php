<?php
  class Product{
    private $table = "products";
    protected $di ;
    public function __construct($di){
      $this->di = $di;
    }


    public function getDataForDataTables(){
      $query = "SELECT p.id as product_id, p.name as product_name, p.specification, psr.selling_rate, p.eoq_level, p.danger_level,cat.name as category_name, GROUP_CONCAT(CONCAT(s.first_name,' ', s.last_name)) as supplier_name from products as p INNER JOIN product_supplier as ps ON p.id = ps.product_id INNER JOIN suppliers as s ON ps.supplier_id = s.id INNER JOIN category as cat ON p.category_id = cat.id INNER JOIN products_selling_rate as psr ON p.id = psr.product_id where p.deleted = 0 GROUP BY p.id ORDER BY p.id ASC";
      
      $res = $this->di->get("Database")->rawQuery($query);
      return $res;
    }

    public function getSellingRate($id){
      return $this->di->get("Database")->readData("products_selling_rate", ["*"], "product_id=".$id);
    }

    public function call(){
      return "hii";
    }
  }
?>