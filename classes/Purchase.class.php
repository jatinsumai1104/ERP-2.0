<?php
require_once(__DIR__."/../helper/requirements.php");
class Purchase{
  private $table = "purchases";
  protected $di ;
  public function __construct($di){
    $this->di = $di;
  }

  public function addPurchase($data){
    try{
      $this->di->get("Database")->beginTransaction();

      for($i = 0; $i < count($data["category_id"]); $i++){
        $this->di->get("Database")->insert($this->table, [
          "product_id" => $data["product_id"][$i],
          "supplier_id" => $data["supplier_id"][$i],
          "purchase_rate" => $data["purchase_rate"][$i],
          "quantity" => $data["quantity"][$i]
        ]);
      }
      Session::setSession("add", "purchase add success");
      $this->di->get("Database")->commit();
    }catch(Exception $e){
      Session::setSession("add", "purchase add fail");
      $this->di->get("Database")->rollback();
    }
  }

  public function getDataForDataTables($fromDate,$toDate){

    $query = $this->di->get("Database")->rawQuery("SELECT products.id,products.name as product_name,category.name as category_name,products.hsn_code, gst.gst_rate,gst.with_effect_from, CONCAT(suppliers.first_name,' ',suppliers.last_name) as supplier_name,purchases.purchase_rate,purchases.quantity,purchases.created_at as purchased_on from purchases INNER JOIN products on purchases.product_id=products.id  INNER JOIN gst on products.hsn_code=gst.hsn_code INNER JOIN suppliers on purchases.supplier_id=suppliers.id INNER JOIN category on products.category_id=category.id INNER JOIN (SELECT hsn_code,gst_rate,max(with_effect_from) as wef from gst GROUP BY hsn_code ) as gst_new on gst_new.wef=gst.with_effect_from AND gst_new.hsn_code = gst.hsn_code WHERE purchases.created_at BETWEEN '2019-08-01' AND '2019-08-31'");
    return $query;
    // print_r($query);

  }
}
?>