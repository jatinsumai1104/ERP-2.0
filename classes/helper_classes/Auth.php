<?php
class Auth {

    protected $di;
    

    protected $table = 'employees';

    protected $session = 'user';

    public function __construct(DependencyInjector $di){
        $this->di = $di;
    }

    // public function build() {
    //     return $this->di->get("Database")->query(
    //     "CREATE TABLE IF NOT EXISTS users(id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, email VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(20) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL)"
    //     );
    // }

    public function create($data)
	{
		if(isset($data['password']))
		{
			$data['password'] = $this->di->get("Hash")->make($data['password']);
		}

		return $this->di->get("Database")->table($this->table)->insert($data);
    }
    
    public function signIn($data){
      $user = $this->di->get("Database")->table($this->table)->where('username', '=', $data['username']);

      if($user->count())
      {
        $user = $user->first();

        if($this->di->get("Hash")->verify($data['password'], $user->password))
        {
          $this->setAuthSession($user->id);

          return true;
        }
      }

      return false;
    }



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
    
    public function signout(){
		unset($_SESSION[$this->session]);
	}
}
