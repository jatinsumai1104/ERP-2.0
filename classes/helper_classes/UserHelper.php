<?php


class UserHelper
{
    private $di;
    public function __construct($di){
		$this->di = $di;
	}

    public function findUserByEmail(string $email){
        return $this->di->get("Database")->fetchAll('select * from users where email =\''.$email.'\'');
    }

    public function findByUsername(string $username){
        return $this->di->get("Database")->fetchAll('select * from users where username =\''.$username.'\'');
    }

}
