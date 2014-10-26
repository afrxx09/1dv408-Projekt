<?php
namespace helpers;

class SessionHelper{
	private $flashMessages;
	public function __construct(){
		$this->flashMessages = new \helpers\FlashMessages($this);
	}

	public function set($key, $var){
		$_SESSION[$key] = $var;
	}
	
	public function get($key){
		return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
	}

	public function add($key, $var){
		$_SESSION[$key][] = $var;
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

	public function setFlash($message, $type){
		$this->flashMessages->setFlash($message, $type);
	}

	public function getFlash(){
		return $this->flashMessages->getFlash();
	}

	public function renderFlash(){
		return $this->flashMessages->renderFlash();
	}
}