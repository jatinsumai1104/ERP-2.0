<?php
  require_once(__DIR__."/../helper/requirements.php");
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


    public function deleteProduct($data){
      $this->di->get("Database")->delete($data['table'], "id = ".$data['id']);
    }

    public function readDataToEdit($data){
      $res = $this->di->get("Database")->readData($this->table, ["*"], "id = ".$data['id'])[0];
      $res["selling_rate"] = $this->getSellingRate($data['id'])[0]["selling_rate"];
      return $res;
    }


    public function addProduct($data){
      try{
        $table_attr = ["name","specification","hsn_code","category_id","eoq_level","danger_level","quantity"];

        $assoc_array = Util::createAssocArray($table_attr,$data);
        $product_id = $this->di->get("Database")->insert($this->table,$assoc_array);

        $tale_attr = ["product_id","supplier_id"];

        $assoc_array = [];
        $assoc_array["product_id"] = $product_id;
        foreach($data["supplier_id"] as $supplier_id){
          $assoc_array["supplier_id"] = $supplier_id;
          $this->di->get("Database")->insert("product_supplier",$assoc_array);
        }

        $assoc_array = [];
        $assoc_array["product_id"] = $product_id;
        $assoc_array["selling_rate"] = $data["selling_rate"];
        $res = $this->di->get("Database")->insert("products_selling_rate",$assoc_array);

        Session::setSession("product_add", "success");
      }catch(Exception $e){
        Session::setSession("product_add", "fail");
      }
    }
  }
?>