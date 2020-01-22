<?php 
require_once(__DIR__."/../helper/requirements.php");
class Customer
{
    private $table="customers";
    protected $di;
    
    public function __construct($di){
		$this->di = $di;
	}

    function readAllCustomers(){
        return $this->di->get("Database")->readData();
    }

    function checkCustomerExist($data){
        $query = "SELECT * from customers WHERE email_id='{$data['customer_email']}'";
        $res = $this->di->get("Database")->rawQuery($query);
        if(count($res)>0){
            return $res;
        }else{
            return [[]];
        }
    }

}

?>