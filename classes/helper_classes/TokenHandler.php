<?php


class TokenHandler {


    private static $REMEMBER_EXPIRY_TIME = '30 minutes';
    private static $FORGOT_PWD_EXPIRY_TIME = '10 minutes';
    private $table = 'tokens';
    private const CREATE_QUERY = "CREATE TABLE IF NOT EXISTS tokens (id bigint primary key auto_increment, user_id int,
                                token varchar(255) UNIQUE, expires_at DATETIME NOT NULL, is_remember TINYINT DEFAULT 0 )";
    private $database;
    private $hasher;

    public function __construct(Database $da, Hash $hash)
    {
        $this->database = $da;
        $this->hasher =$hash;
    }

    public static function getCurrentTimeInMillis(){
        return round(microtime(true) * 1000);
    }

    public function build()
    {
        $this->database->query(TokenHandler::CREATE_QUERY);
    }

    /**
     * Returns a row if a valid token exists for the given user id.By default php ints are 64 bits.
     * @param int $id
     * @param int $isRemember
     * @return
     */
    public function getValidExistingToken(int $id, int $isRemember){
        $retval = $this->database->fetchAll('
            SELECT * FROM tokens WHERE user_id = '.$id.' and expires_at >= NOW() and is_remember = '.$isRemember.'; 
        ');
        return $retval == null? null: $retval[0]["token"] ;
    }

    public function createForgotPasswordToken(int $userId){
        return $this->createToken($userId, 0 );
    }


    public function isValid(string $token, int $isRemember){
        //$token = stripslashes($token);
        $current =date('Y-m-d H:i:s');
        return !empty($this->database->fetchAll(
            'SELECT * FROM tokens WHERE token = \''.$token. '\' and expires_at >= \''.$current.'\' and is_remember = '.$isRemember
        ));

    }

    public function createRememberMeToken(int $userId){
        return $this->createToken($userId, 1);
    }

    private function createToken(int $userId, int $isRemember){
        $validToken = $this->getValidExistingToken($userId, $isRemember);
        if($validToken)
            return $validToken;
        $current =date('Y-m-d H:i:s');
        $timeToBeAdded = $isRemember ? TokenHandler::$REMEMBER_EXPIRY_TIME : TokenHandler::$FORGOT_PWD_EXPIRY_TIME;
        $data = [
            'user_id' => $userId,
            'token' => $this->hasher->generateForgotToken($userId),
            'expires_at' => date('Y-m-d H:i:s', strtotime($current.'+'.$timeToBeAdded)),
            'is_remember' => $isRemember
        ];
        return $this->database->table($this->table)->insert($data) ? $data : null;
    }

}