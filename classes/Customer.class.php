<?php
class Customer
{
    private $table = "customers";
    protected $di;

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function getDataForDataTables()
    {
        $query = "SELECT customer_id,first_name,last_name,gst_no,phone_no,email_id,gender,CONCAT(block_no,' ',street,' ',city,' ',pincode,' ',state,' ',country,' ',town) AS address_of_customer FROM customers c INNER JOIN address_customer a_c ON c.id = a_c.customer_id INNER JOIN address a ON a_c.address_id = a.id WHERE c.deleted = 0";
        $res = $this->di->get("Database")->rawQuery($query);
        return $res;
    }

    public function readDataToEdit($customer_id)
    {
        $query = "SELECT customer_id,address_id,first_name,last_name,gst_no,phone_no,email_id,gender,block_no,street,city,pincode,state,country,town FROM customers c INNER JOIN address_customer a_c ON c.id = a_c.customer_id INNER JOIN address a ON a_c.address_id = a.id WHERE customer_id = " . $customer_id;
        $res = $this->di->get("Database")->rawQuery($query);
        return $res;
    }

    public function validateData($data)
    {
        $validator = $this->di->get("Validator");
        $validation = $validator->check($data, [
            'first_name' => [
                'required' => true,
                'minlength' => 3,
                'maxlength' => 20,
            ],
            'last_name' => [
                'required' => true,
                'minlength' => 3,
                'maxlength' => 20,
            ],
            'gst_no' => [
                'required' => true,
            ],
            'phone_no' => [
                'required' => true,
                'phone' => true,
            ],
            'email_id' => [
                'required' => true,
                'maxlength' => 200,
                'unique' => 'customers',
                'email' => true,
            ],
            'gender' => [
                'required' => true,
            ],
            'block_no' => [
                'required' => true,
            ],
            'street' => [
                'required' => true,
            ],
            'city' => [
                'required' => true,
            ],
            'pincode' => [
                'required' => true,
            ],
        ]);
        return $validation;
    }

    public function addCustomer($data)
    {

        $validation = $this->validateData($data);

        if (!$validation->fails()) {
            try {
                $customer_table_attr = ["first_name", "last_name", "gst_no", "phone_no", "email_id", "gender"];
                $customer_assoc_array = Util::createAssocArray($customer_table_attr, $data);

                $address_table_attr = ["block_no", "street", "city", "pincode", "state", "country", "town"];
                $address_assoc_array = Util::createAssocArray($address_table_attr, $data);

                // Begin Transaction
                $this->di->get("Database")->beginTransaction();

                $customer_id = $this->di->get("Database")->insert($this->table, $customer_assoc_array);
                $address_id = $this->di->get("Database")->insert("address", $address_assoc_array);
                $address_customer_assoc_array["address_id"] = $address_id;
                $address_customer_assoc_array["customer_id"] = $customer_id;
                $address_customer_id = $this->di->get("Database")->insert("address_customer", $address_customer_assoc_array);
                
                $this->di->get("Database")->commit();
                Session::setSession("customer_add", "success");
            } catch (Exception $e) {
                $this->di->get("Database")->rollback();
                Session::setSession("customer_add", "fail");
            }
        } else {
            Session::setSession("customer_add", "fail");
        }
    }

    // Not Editing Email Id because its unique
    public function updateCustomer($data)
    {
        $validation = $this->validateData($data);
        if (!$validation->fails()) {
            try {
                $customer_table_attr = ["first_name", "last_name", "gst_no", "phone_no", "gender"];
                $customer_assoc_array = Util::createAssocArray($customer_table_attr, $data);

                $address_table_attr = ["block_no", "street", "city", "pincode", "state", "country", "town"];
                $address_assoc_array = Util::createAssocArray($address_table_attr, $data);

                $this->di->get("Database")->beginTransaction();
                
                $this->di->get("Database")->update($this->table, $customer_assoc_array, "id={$data['customer_id']}");
                $this->di->get("Database")->update("address", $address_assoc_array, "id={$data['address_id']}");
                
                $this->di->get("Database")->commit();
                Session::setSession("customer_edit", "success");
            } catch (Exception $e) {
                $this->di->get("Database")->rollback();
                Session::setSession("customer_edit", "fail");
            }
        } else {
            Session::setSession("customer_edit", "fail");
        }
    }

    public function deleteCustomer($data)
    {
        try {
            $query = "SELECT address_id FROM customers c INNER JOIN address_customer a_c ON c.id = a_c.customer_id INNER JOIN address a ON a_c.address_id = a.id WHERE customer_id = " . $data['id'];
            $res = $this->di->get("Database")->rawQuery($query);
            
            $this->di->get("Database")->beginTransaction();
            
            $this->di->get("Database")->delete($data['table'], "id = " . $data['id']);
            $this->di->get("Database")->delete("address", "id = " . $res[0]['address_id']);

            $this->di->get("Database")->commit();
        } catch (Exception $e) {
            $this->di->get("Database")->rollback();
            Session::setSession("supplier_delete", "fail");
        }
    }

}
