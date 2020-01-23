<?php
require_once __DIR__ . "/../helper/requirements.php";
class Category
{
    private $table = "category";
    protected $di;
    public function __construct($di)
    {
        $this->di = $di;
    }

    public function validateData($data)
    {
        $validator = $this->di->get("Validator");
        $validation = $validator->check($data, [
            'name' => [
                'required' => true,
                'minlength' => 3,
                'maxlength' => 20,
            ],
        ]);
        return $validation;
    }

    public function addCategory($data){
        $validation = $this->validateData($data);

        if (!$validation->fails()) {

            try {
                // Begin Transaction
                $this->di->get("Database")->beginTransaction();
                $assoc_array = ["name" => $data['name']];
                $category_id = $this->di->get("Database")->insert($this->table, $assoc_array);
                $this->di->get("Database")->commit();
                // end transaction
                Session::setSession("add", "Add Category success");
            } catch (Exception $e) {
                $this->di->get("Database")->rollback();
                Session::setSession("add", "Add Category error");
            }
        } else {
          Session::setSession("validation", "Category Validation error");
        }
    }

    public function readDataToEdit($data){
      $res = $this->di->get("Database")->readData($this->table, ["*"], "id = ".$data['id'])[0];
      return $res;
    }

    public function getAllCategories(){
      return $this->di->get("Database")->readData($this->table);
    }

    public function update($data){
      $validation = $this->validateData($data);

      if (!$validation->fails()) {
          try{
            $this->di->get("Database")->beginTransaction();
            $assoc_array["name"] = $data["name"];
            $this->di->get("Database")->update($this->table, $assoc_array, "id={$data['category_id']}");
            $this->di->get("Database")->commit();
            Session::setSession("edit", "Edit Category success");
          }catch(Exception $e){
            $this->di->get("Database")->rollback();
            Session::setSession("edit", "Edit Category error");
          }
      }else{
        Session::setSession("validation", "Category Validation error");
      }
    }

    

    public function delete($data){
      try {
          $this->di->get("Database")->beginTransaction();
          
          $this->di->get("Database")->delete($this->table, "id = " . $data['id']);
          
          $this->di->get("Database")->commit();
          Session::setSession("edit", "delete product success");
      } catch (Exception $e) {
          $this->di->get("Database")->rollback();
          Session::setSession("edit", "delete product error");
      }
  }

}
?>
