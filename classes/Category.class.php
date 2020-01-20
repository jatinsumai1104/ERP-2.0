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

    public function addCategory($data)
    {
        $validation = $this->validateData($data);

        if (!$validation->fails()) {

            try {

                // Begin Transaction
                $this->di->get("Database")->beginTransaction();
                $assoc_array = ["name" => $data['name']];
                $category_id = $this->di->get("Database")->insert($this->table, $assoc_array);
                $this->di->get("Database")->commit();
                // end transaction
                Session::setSession("category_add", "success");
            } catch (Exception $e) {
                $this->di->get("Database")->rollback();
                Session::setSession("category_add", "fail");
            }
        } else {
            Session::setSession("category_add", "fail");
        }
    }

}
