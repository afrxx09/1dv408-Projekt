<?php

class Controller{
	
	protected $params;
	protected $view;
	public $models = array();

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
	
	public function __set($key, $val){
		$this->{$key} = $val;
	}
	
	public function __get($key){
		return (isset($this->{$key})) ? $this->{$key} : null;
	}
}