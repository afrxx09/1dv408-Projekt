<?php
namespace helpers;

class Session{
	public function set($key, $var){
		$_SESSION[$key] = $var;
	}
	
	public function get($key){
		return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
	}
	
	public function delete($key){
		if(isset($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	}
	
	public function clear(){
		$_SESSION = null;
	}
	
	public function destroy(){
		$_SESSION = null;
		session_destroy();
	}
}