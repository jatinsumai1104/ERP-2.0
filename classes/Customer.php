<?php 
class Customer
{
    private $table="customers";
    private $db;
    
    public function __construct(Database $db){
        $this->db = $db;
    }

    function readAllCustomers(){
        $customerData =  $this->db->readData($this->table);
        return $customerData;
    }

}

?>