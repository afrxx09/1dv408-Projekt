<?php

class Controller{
	
	protected $params;
	protected $view;

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
	
	public function getView(){
		if(isset($this->view)){
			return $this->view;
		}
		return new \core\AppView();
	}
}