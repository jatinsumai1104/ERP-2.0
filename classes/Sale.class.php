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
            $assoc_array["customer_id"] = $data['customer_id'];
            $invoice_id = $this->di->get("Database")->insert("invoice",$assoc_array);
            $assoc_array = [];
           
            $this->di->get("Database")->commit();
            Session::setSession("product_add", "success");
          }catch(Exception $e){
            $this->di->get("Database")->rollback();
            Session::setSession("product_add", "fail");
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