<?php
require_once(__DIR__."/../helper/requirements.php");
class Supplier{
  private $table = "suppliers";
  protected $di ;
  public function __construct($di){
    $this->di = $di;
  }

    public function addSupplier($data){
      try{
        
        $table_attr = ["first_name","last_name","gst_no","phone_no","email_id","company_name"];
        $assoc_array = Util::createAssocArray($table_attr,$data);
       // print_r ($assoc_array);
        // Begin Transaction
        $this->di->get("Database")->beginTransaction();

        $supplier_id = $this->di->get("Database")->insert($this->table,$assoc_array);
        //echo $supplier_id;

        $this->di->get("Database")->commit();
        Session::setSession("supplier_add", "success");
      }catch(Exception $e){
        $this->di->get("Database")->rollback();
        Session::setSession("supplier_add", "fail");
      }
    }

  }
?>