<?php
class Auth {

    protected $database;
    protected $hash;

    protected $table = 'employees';

    protected $session = 'user';

    public function __construct(Database $database, Hash $hash){
        $this->database = $database;
        $this->hash = $hash;
    }

    // public function build() {
    //     return $this->database->query(
    //     "CREATE TABLE IF NOT EXISTS users(id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, email VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(20) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL)"
    //     );
    // }

    public function create($data)
	{
		if(isset($data['password']))
		{
			$data['password'] = $this->hash->make($data['password']);
		}

		return $this->database->table($this->table)->insert($data);
    }
    
    public function signin($data){
		$user = $this->database->table($this->table)->where('username', '=', $data['username']);

		if($user->count())
		{
			$user = $user->first();

			if($this->hash->verify($data['password'], $user->password))
			{
				$this->setAuthSession($user->id);

				return true;
			}
		}

		return false;
    }



    public function updateUserPassword(string $token, string $password){
        $password=$this->hash->make($password);
        return $this->database->query( "update users, tokens
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
