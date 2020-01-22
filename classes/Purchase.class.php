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
}
?>