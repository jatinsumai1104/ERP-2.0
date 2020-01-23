<?php
require_once __DIR__ . "/../helper/requirements.php";
class Product
{
    private $table = "products";
    protected $di;
    public function __construct($di)
    {
        $this->di = $di;
    }

    public function getDataForDataTables()
    {
        $query = "SELECT p.id as product_id, p.name as product_name, p.specification, psr.selling_rate, p.eoq_level, p.danger_level,cat.name as category_name, GROUP_CONCAT(CONCAT(s.first_name,' ', s.last_name)) as supplier_name, max(psr.with_effect_from) as wef from products as p INNER JOIN product_supplier as ps ON p.id = ps.product_id INNER JOIN suppliers as s ON ps.supplier_id = s.id INNER JOIN category as cat ON p.category_id = cat.id INNER JOIN products_selling_rate as psr ON p.id = psr.product_id INNER JOIN (select product_id, max(with_effect_from) as MaxDate from products_selling_rate group by product_id) as tm ON psr.product_id = tm.product_id and psr.with_effect_from = tm.MaxDate where p.deleted = 0 GROUP BY p.id HAVING max(psr.with_effect_from) ORDER BY p.id ASC";

        $res = $this->di->get("Database")->rawQuery($query);
        return $res;
    }

    public function getSellingRate($id)
    {
        $query = "select t.selling_rate, t.with_effect_from as wef from products_selling_rate t inner join (select product_id, max(with_effect_from) as MaxDate from products_selling_rate group by product_id) tm on t.product_id = tm.product_id and t.with_effect_from = tm.MaxDate WHERE t.product_id = {$id}";
        $res = $this->di->get("Database")->rawQuery($query);
        return $res;
    }

    public function readDataToEdit($data)
    {
        $res = $this->di->get("Database")->readData($this->table, ["*"], "id = " . $data['id'])[0];
        $res["psr"] = $this->getSellingRate($data['id'])[0];
        return $res;
    }

    public function validateData($data){
        $validator = $this->di->get("Validator");
        $validation = $validator->check($data, [
            'name' => [
                'required' => true,
                'minlength' => 3,
                'maxlength' => 20,
            ],
            'specification' => [
                'required' => true,
                'minlength' => 3,
                'maxlength' => 250,
            ],
            'hsn_code' => [
                'required' => true,
            ],
            'category_id' => [
                'required' => true,
            ],
            'eoq_level' => [
                'required' => true,
            ],
            'danger_level' => [
                'required' => true,
            ],
            'quantity' => [
                'required' => true,
            ],
        ]);
        return $validation;
    }

    public function addProduct($data){
        $validation = $this->validateData($data);
        if (!$validation->fails()) {
            try {
                $table_attr = ["name", "specification", "hsn_code", "category_id", "eoq_level", "danger_level", "quantity"];
                $assoc_array = Util::createAssocArray($table_attr, $data);

                // Begin Transaction
                $this->di->get("Database")->beginTransaction();
                $product_id = $this->di->get("Database")->insert($this->table, $assoc_array);

                $tale_attr = ["product_id", "supplier_id"];

                $assoc_array = [];
                $assoc_array["product_id"] = $product_id;
                foreach ($data["supplier_id"] as $supplier_id) {
                    $assoc_array["supplier_id"] = $supplier_id;
                    $this->di->get("Database")->insert("product_supplier", $assoc_array);
                }

                $assoc_array = [];
                $assoc_array["product_id"] = $product_id;
                $assoc_array["selling_rate"] = $data["selling_rate"];
                $res = $this->di->get("Database")->insert("products_selling_rate", $assoc_array);
                $this->di->get("Database")->commit();
                Session::setSession("add", "Add Product success");
            } catch (Exception $e) {
                $this->di->get("Database")->rollback();
                Session::setSession("add", "Add Product error");
            }
        } else {
            Session::setSession("validation", "Product Validation error");
        }
    }

    public function update($data){
        $validation = $this->validateData($data);
        if (!$validation->fails()) {
            try {
                $this->di->get("Database")->beginTransaction();
                $table_attr = ["name", "specification", "eoq_level", "danger_level"];
                $assoc_array = Util::createAssocArray($table_attr, $data);
                $this->di->get("Database")->update($this->table, $assoc_array, "id={$data['product_id']}");
                if (!($data["old_selling_rate"] == $data["selling_rate"])) {
                    $this->di->get("Database")->insert("products_selling_rate", ["product_id" => $data["product_id"], "selling_rate" => $data["selling_rate"]]);
                }
                $this->di->get("Database")->commit();
                Session::setSession("edit", "Edit Product success");
            } catch (Exception $e) {
                $this->di->get("Database")->rollback();
                Session::setSession("edit", "Edit Product error");
            }
        }else{
            Session::setSession("validation", "Product Validation error");
        }
    }

    public function delete($data){
        try {
            $this->di->get("Database")->beginTransaction();
            
            $this->di->get("Database")->delete($this->table, "id = " . $data['id']);
            
            $this->di->get("Database")->commit();
            Session::setSession("delete", "Delete product success");
        } catch (Exception $e) {
            $this->di->get("Database")->rollback();
            Session::setSession("delete", "Delete product error");
        }
    }
}