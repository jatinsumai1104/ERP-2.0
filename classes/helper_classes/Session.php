<?php 


class Session{
	public static function start_session(){
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}
	public static function startSession($user_id){
		self::start_session();
		$_SESSION['id'] = $user_id;
	}
	public static function isSessionStart(){
		self::start_session();
		if(isset($_SESSION['id'])){
			return true;
		}else{
			return false;
		}
	}
	public static function destroySession(){
		if(self::isSessionStart()){
			unset($_SESSION['id']);
			session_destroy();
			return 1;
		}else{
			return 0;
		}
  }
  
  public static function setSession($key, $value){
    self::start_session();
    $_SESSION[$key] = $value;
  }

  public static function getSession($key){
    if(!(session_status() == PHP_SESSION_NONE) && isset($_SESSION[$key])){
      return $_SESSION[$key];
    }
  }
}

?>