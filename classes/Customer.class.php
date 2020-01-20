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

    public function addCustomer($data){

      $validator = $this->di->get("Validator");
      $validation = $validator->check($data, [
        'first_name' => [
            'required' => true,
            'minlength' => 3,
            'maxlength' =>20
        ],
        'last_name' => [
          'required' => true,
          'minlength' => 3,
          'maxlength' =>20
        ],
        'gst_no' => [
          'required' => true
        ], 
        'phone_no' => [
          'required' => true,
          'phone' => true
        ],
        'email_id' => [
            'required' => true,
            'maxlength' => 200,
            'unique' => 'customers',
            'email' => true
        ],
        'gender' => [
            'required' => true
        ],
        'block_no' => [
            'required' => true
        ],
        'street' => [
          'required' => true
        ],
        'city' => [
          'required' => true
        ],
        'pincode' => [
          'required' => true
        ],
    ]);

    if(!$validation->fails()){
      try{        
        $customer_table_attr = ["first_name","last_name","gst_no","phone_no","email_id","gender"];
        $customer_assoc_array = Util::createAssocArray($customer_table_attr,$data);

        $address_table_attr = ["block_no","street","city","pincode","state","country","town"];
        $address_assoc_array = Util::createAssocArray($address_table_attr,$data);
        
        // Begin Transaction
        $this->di->get("Database")->beginTransaction();
        $customer_id = $this->di->get("Database")->insert($this->table,$customer_assoc_array);
        $address_id = $this->di->get("Database")->insert("address",$address_assoc_array);

        $address_customer_assoc_array["address_id"]=$address_id;  
        $address_customer_assoc_array["customer_id"]=$customer_id;

        $address_customer_id = $this->di->get("Database")->insert("address_customer",$address_customer_assoc_array);
        
        $this->di->get("Database")->commit();
        Session::setSession("customer_add", "success");
      }catch(Exception $e){
        $this->di->get("Database")->rollback();
        Session::setSession("customer_add", "fail");
      }
    }else{
      Session::setSession("customer_add", "fail");
      echo "Fail";
    }
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