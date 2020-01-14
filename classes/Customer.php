<?php 
class Customer
{
    private $table="customers";
    private $id;
    private $first_name;
    private $last_name;
    private $gst_no;
    private $phone_no;
    private $email_id;
    private $gender;
    private $deleted;
    private $created_at;
    private $updated_at;
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