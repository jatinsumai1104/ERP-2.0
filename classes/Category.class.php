<?php
require_once(__DIR__."/../helper/requirements.php");
class Category{
  private $table = "category";
  protected $di ;
  public function __construct($di){
    $this->di = $di;
  }

    public function addCategory($data){
      try{
        
        // Begin Transaction
        $this->di->get("Database")->beginTransaction();
        $assoc_array = ["name" => $data['name']];
        $category_id = $this->di->get("Database")->insert($this->table,$assoc_array);
        $this->di->get("Database")->commit();
        // end transaction
        Session::setSession("category_add", "success");
      }catch(Exception $e){
        $this->di->get("Database")->rollback();
        Session::setSession("category_add", "fail");
      }
    }

    public function getAllCategories(){
      return $this->di->get("Database")->readData($this->table);
    }

  }
?>