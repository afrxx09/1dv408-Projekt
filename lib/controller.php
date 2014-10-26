<?php

/**
*	Main controller class.
*	Methods mostly used by dispatcher to controll the flow of the application.
*/
class Controller{
	
	protected $params;
	protected $view;
	protected $helpers = array();
	protected $appHelpers = array(); 

	public function __set($key, $val){
		$this->{$key} = $val;
	}
	
	public function __get($key){
		return (isset($this->{$key})) ? $this->{$key} : null;
	}
	
	protected function redirectTo($controller = null, $action = null, $param = null){
		$path = ($controller !== null) ? $controller : \Config::DEFAULT_CONTROLLER;
		if($action !== null){
			$path .= '/' . $action;
			if($param !== null){
				$path.= '/' . $param;
			}
		}
		header('Location: ' . ROOT_PATH . $path);
		exit;
	}

	public function setParams($params){
		$this->params = $params;
	}
	
	public function setView($view){
		$this->view = $view;
	}

	public function getHelpers(){
		return array_merge($this->helpers, $this->appHelpers);
	}
}