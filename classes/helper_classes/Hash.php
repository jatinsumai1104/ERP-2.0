<?php

class Hash{

    public function __construct($di){
		$this->di = $di;
    }
    
    public function make($plainText){
        return password_hash($plainText, PASSWORD_BCRYPT, ['cost'=>10]);
    }

    public function verify($plainText, $hash){
        return password_verify($plainText, $hash);
    }

    public function generateForgotToken($id){
        return hash('sha256', $id.TokenHandler::getCurrentTimeInMillis().strrev($id).rand());
    }



}