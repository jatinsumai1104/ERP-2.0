<?php 
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

}

?>