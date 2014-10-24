<?php
namespace helpers;

class Cookie{
	public function check($key){
		return isset($_COOKIE[$key]);
	}
	
	public function set($key, $value){
		$_COOKIE[$key] = $value;
	}
	
	public function get($key){
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}
	
	public function destroy($key){
		unset($_COOKIE[$key]);
	}
	
	public function clear(){
		$_COOKIE = null;
	}
}