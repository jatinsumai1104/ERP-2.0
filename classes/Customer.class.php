<?php 
class Customer
{
    private $table="customers";
    protected $di;
    
    public function __construct($di){
		$this->di = $di;
	}

    public function readAllCustomers(){
        return $this->di->get("Database")->readData($this->table,["*"],"deleted=0");
    }

    public function readDataToEdit($data){
        $res = $this->di->get("Database")->readData($this->table, ["*"], "id = ".$data['id'])[0];
        return $res;
    }

    public function updateCustomer($data){
        try{
          $this->di->get("Database")->beginTransaction();
          $table_attr = ["first_name", "last_name", "gst_no", "phone_no","email_id","gender"];
          $assoc_array = Util::createAssocArray($table_attr,$data);
          print_r($data);
          $this->di->get("Database")->update($this->table, $assoc_array, "id={$data['customer_id']}");
          $this->di->get("Database")->commit();
          Session::setSession("customer_edit", "success");
        }catch(Exception $e){
          $this->di->get("Database")->rollback();
          Session::setSession("customer_edit", "fail");
        }
    }



}

?>