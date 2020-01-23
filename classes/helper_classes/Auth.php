<?php

require_once(__DIR__."/../../helper/requirements.php");
class Auth {

    protected $di;
    

    protected $table = 'employees';

    public function __construct(DependencyInjector $di){
        $this->di = $di;
    }
    
    // public function signIn($data){
    //   $user = $this->di->get("Database")->table($this->table)->where('username', '=', $data['username']);

    //   if($user->count())
    //   {
    //     $user = $user->first();

    //     if($this->di->get("Hash")->verify($data['password'], $user->password))
    //     {
    //       $this->setAuthSession($user->id);

    //       return true;
    //     }
    //   }

    //   return false;
    // }



    public function updateUserPassword(string $token, string $password){
        $password=$this->di->get("Hash")->make($password);
        return $this->di->get("Database")->query( "update users, tokens
        set users.password = '$password', tokens.expires_at= NOW() 
        where users.id = tokens.user_id and tokens.token = '$token'");
    }
    
    protected function setAuthSession($id){
		$_SESSION[$this->session] = $id;
    }
    
    public function check(){
		return isset($_SESSION[$this->session]);
    }
    
    public function register($input){
      $email = $input['email'];
      $password = $input['password'];
      $repeat_password = $input['repeat_password'];

      $validator = $this->di->get("Validator");
      $validation = $validator->check($input, [
          'email' => [
              'required' => true,
              'maxlength' => 200,
              'unique' => 'employees',
              'email' => true
          ],
          'password' => [
              'required' => true,
              'minlength' => 5
          ]
      ]);

      if($validation->errors())
      {
        Session::setSession("sign_up", "Sign Up error");
        Session::setSession("validation", "Product Validation error");
      }
      else
      {
          // CODE TO BE EXECUTED IF THE VALIDATION HAS NO ERRORS

          try{

            $this->di->get("Database")->beginTransaction();
              
            $hashed_password = $this->di->get("Hash")->make($password);
    
            $data = ['block_no','street','city','pincode','state','country','state','country','town'];
            $insertion_array = Util::createAssocArray($data,$input);
            $address_id = $this->di->get("Database")->insert('address', $insertion_array);

            $input['password_hash'] = $hashed_password;
            $input['address_id'] = $address_id;

            $data = ['first_name','last_name','email','password_hash','phone_no','gender','address_id'];
            $insertion_array2 = Util::createAssocArray($data,$input);
            $this->di->get("Database")->insert('employees', $insertion_array2);

            $this->di->get("Database")->commit();
            Session::setSession("sign_up", "Sign-up success");
            Util::redirect("login");
          }catch(Exception $e){
            Session::setSession("sign_up", "Sign-up error");
            $this->di->get("Database")->rollback();
          }
      }
      
    }

    public function login($input){
      

      $email = $input['email'];
      $password = $input['password'];

      // $this->di->get("Database")->beginTransaction();

      if(!$this->di->get("Database")->exists("employees",["email"=>$email])){
        Session::setSession("login", "Login employee_already_present error");
        Util::redirect("login");
      }else{
        $hashed_password =$this->di->get("Database")->readData("employees",["password_hash"],"email='{$email}'");
        $db_password = $hashed_password[0]['password_hash'];
        
        if($this->di->get("Hash")->verify($password,$db_password)){
          // echo "verified";
          $id = $this->di->get("Database")->readData("employees",["id"],"email='{$email}'");
          Session::setSession("employee_id",$id[0]['id']);
          Session::setSession("login","success");
          if(isset($input['remember'])){
            $this->setCookie($id[0]['id']);
          }
          Session::setSession("login","Login Employee success");
          Util::redirect("index");
        }else{
          Session::setSession("login","Login Incorrect_username/password error");
          Util::redirect("login");
        }

      }
      
      

      
      
    }

    public function setCookie($id){
      $token = $this->di->get("TokenHandler")->createRememberMeToken($id);
      // print_r($token);
      setcookie("token",$token['token'],time() + 1800, '/');
      setcookie("user_id",$token['user_id'], time() + 1800, '/');

      // if(isset($_COOKIE['token'])&& isset($_COOKIE['user_id'])){
      //   echo $_COOKIE['token']." ".$_COOKIE['user_id'];
      // }
    }
}
