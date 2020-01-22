<?php 
class Sale
{
    private $table="sales";
    protected $di;
    
    public function __construct($di){
		$this->di = $di;
	}

    function addProducts($data){
        try{
    
            // Begin Transaction
            $this->di->get("Database")->beginTransaction();
            $assoc_array=[];
            $assoc_array["customer_id"] = $data['customer_id'];
            $invoice_id = $this->di->get("Database")->insert("invoice",$assoc_array);
            
            for($i=0;$i<count($data['product_id']);$i++){
                $assoc_array = [];
                $assoc_array["product_id"] = $data['product_id'][$i];
                $assoc_array["quantity"] = $data['quantity'][$i];
                $assoc_array["discount"] = $data['discount'][$i];
                $assoc_array["invoice_id"] = $invoice_id;
                $sales_id = $this->di->get("Database")->insert($this->table,$assoc_array);
            }
            $assoc_array = [];
            $assoc_array["invoice_id"]=$invoice_id;
            $assoc_array["amount"] = $data["amount"];
            if($data["pay_mode"] == "cash"){
                    $assoc_array["pay_mode"] = $data["pay_mode"];
                    $payment_id = $this->di->get("Database")->insert("payments",$assoc_array);
            }else if($data["pay_mode"] == "cheque"){
                    $assoc_array["pay_mode"] = $data["pay_mode"];
                    $payment_id = $this->di->get("Database")->insert("payments",$assoc_array);
                    $assoc_array = [];
                    $assoc_array["payment_id"] = $payment_id;
                    $assoc_array["cheque_no"] = $data["cheque_no"];
                    $assoc_array["cheque_date"] = $data["cheque_date"];
                    $assoc_array["bank_name"] = $data["bank_name"];
                    $cheque_details_id = $this->di->get("Database")->insert("cheque_details",$assoc_array);
            }
           
            $this->di->get("Database")->commit();
            Session::setSession("sales_add", "success");
          }catch(Exception $e){
            $this->di->get("Database")->rollback();
            Session::setSession("sales_add", "fail");
          }
    }

    function getTotalRate($data){
        
        $product_rates = [];
        foreach($data['product_id'] as $product_id){
        $query = "SELECT selling_rate from products_selling_rate GROUP BY product_id HAVING max(with_effect_from) and product_id={$product_id}";
            $res = $this->di->get("Database")->rawQuery($query);
            array_push($product_rates,$res[0]);
        }
        $result_arr=[];
        $res=0;
        // var_dump($product_rates);
        // var_dump($data["quantity_id"][0] * $product_rates[0]["selling_rate"]);
        for($i=0;$i<count($data['quantity_id']);$i++){
            $res=0;
            $res+=($product_rates[$i]["selling_rate"]*$data['quantity_id'][$i]);
            $res-= ($data['discount_id'][$i]*$res/100);
            array_push($result_arr,$res);
        }
        $sum=0;
        foreach($result_arr as $ele){
            $sum += $ele;
        }
        return $sum;
       
        
    }

}

?>