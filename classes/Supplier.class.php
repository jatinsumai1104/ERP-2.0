<?php
require_once __DIR__ . "/../helper/requirements.php";
class Supplier
{
    private $table = "suppliers";
    protected $di;

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function getDataForDataTables()
    {
        $query = "SELECT s.id as supplier_id, s.first_name,s.last_name,s.gst_no,s.phone_no,s.email_id,s.company_name,CONCAT(a.block_no,' ',a.street,' ',a.city,' ',a.pincode,' ',a.state,' ',a.country,a.town) as address_of_supplier FROM `suppliers` as s INNER JOIN address_supplier as a_s ON s.id = a_s.supplier_id INNER JOIN address as a ON a_s.address_id = a.id";
        $res = $this->di->get("Database")->rawQuery($query);
        return $res;
    }

    public function addSupplier($data)
    {
        try {

            $table_attr = ["first_name", "last_name", "gst_no", "phone_no", "email_id", "company_name"];
            $assoc_array = Util::createAssocArray($table_attr, $data);
            // Begin Transaction
            $this->di->get("Database")->beginTransaction();

            $supplier_id = $this->di->get("Database")->insert($this->table, $assoc_array);
            //echo $supplier_id;
            $table_attr = [];
            $assoc_array = [];
            $table_attr = ["block_no", "street", "city", "pincode", "state", "country", "town"];
            $assoc_array = Util::createAssocArray($table_attr, $data);
            $address_id = $this->di->get("Database")->insert("address", $assoc_array);

            $assoc_array = [];
            $assoc_array['address_id'] = $address_id;
            $assoc_array['supplier_id'] = $supplier_id;
            $address_supplier_id = $this->di->get("Database")->insert("address_supplier", $assoc_array);

            $this->di->get("Database")->commit();
            // end transaction
            Session::setSession("supplier_add", "success");
        } catch (Exception $e) {
            $this->di->get("Database")->rollback();
            Session::setSession("supplier_add", "fail");
        }
    }

    public function readDataToEdit($supplier_id)
    {
        $query = "SELECT s.id as supplier_id, s.first_name,s.last_name,s.gst_no,s.phone_no,s.email_id,s.company_name,a.id as address_id,a.block_no,a.street,a.city,a.pincode,a.state,a.country,a.town FROM `suppliers` as s INNER JOIN address_supplier as a_s ON s.id = a_s.supplier_id INNER JOIN address as a ON a_s.address_id = a.id WHERE supplier_id = {$supplier_id}";
        $res = $this->di->get("Database")->rawQuery($query);
        return $res;
    }

    public function updateSupplier($data)
    {

        try {
            $this->di->get("Database")->beginTransaction();
            $table_attr = ["first_name", "last_name", "gst_no", "phone_no", "email_id", "company_name"];
            $assoc_array = Util::createAssocArray($table_attr, $data);
            $this->di->get("Database")->update($this->table, $assoc_array, "id={$data['supplier_id']}");
            $table_attr = ["block_no", "street", "city", "pincode", "state", "country", "town"];
            $assoc_array = Util::createAssocArray($table_attr, $data);
            $this->di->get("Database")->update("address", $assoc_array, "id={$data['address_id']}");
            $this->di->get("Database")->commit();
            Session::setSession("supplier_edit", "success");
        } catch (Exception $e) {
            $this->di->get("Database")->rollback();
            Session::setSession("supplier_edit", "fail");
        }
    }

    public function delete($data)
    {
        try {
            $res = "SELECT a.id as address_id FROM `suppliers` as s INNER JOIN address_supplier as a_s ON s.id = a_s.supplier_id INNER JOIN address as a ON a_s.address_id = a.id WHERE supplier_id = {$data['id']}";
            $this->di->get("Database")->beginTransaction();

            $this->di->get("Database")->delete($data['table'], "id = " . $data['id']);

            $this->di->get("Database")->delete("address", "id = " . $res['address_id']);

            $this->di->get("Database")->commit();

        } catch (Exception $e) {
            $this->di->get("Database")->rollback();
            Session::setSession("supplier_delete", "fail");
        }
    }

}
