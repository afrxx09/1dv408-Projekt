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
		return $this->view;
	}

	public function getScript(){
		return $this->view->getScript();
	}
	public function getCSS(){
		return $this->view->getCSS();
	}
}