<?php


class UserHelper
{
    private $database;
    private $hash;
    public function __construct(Database $ref, Hash $hash)
    {
        $this->database = $ref;
        $this->hash = $hash;
    }

    public function findUserByEmail(string $email){
        return $this->database->fetchAll('select * from users where email =\''.$email.'\'');
    }

    public function findByUsername(string $username){
        return $this->database->fetchAll('select * from users where username =\''.$username.'\'');
    }

}
