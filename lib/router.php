<?php

class Router{
	private $url;
	private $controllerName;
	private $action;
	private $params = array();

	private $controller;
	private $view;
	private $model;
	
	private $layoutView;

	public function __construct(LayoutView $layoutView){
		$this->layoutView = $layoutView;
		$this->getURL();
		$this->parseURL();
		$this->setController();
		$this->setView();
		$this->setModel();
	}

	private function getURL(){
		$url = isset($_GET['url']) ? $_GET['url'] : '';
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$this->url = $url;
	} 

	private function parseURL(){
		$route = explode('/', $this->url);
		$root = \Routes::getRoot();
		if(empty($route[0]) && $root !== null){
			$this->controllerName = $root[0];
			$this->action = isset($root[1]) ? $root[1] : \Config::DEFAULT_ACTION;
		}
		else{
			$this->controllerName = (!empty($route[0])) ? $route[0]: \Config::DEFAULT_CONTROLLER;
			$this->action = (!empty($route[1])) ? $route[1]: \Config::DEFAULT_ACTION;
			for($i = 2; $i < count($route); $i ++){
				$this->params[] = $route[$i];
			}
		}
	}

	private function setController(){
		$class = '\controllers\\' . ucfirst($this->controllerName) . 'Controller';
		if(!class_exists($class)){
			throw new \Exception('Could not find controller class: ' . $class);
		}
		$this->controller = new $class();
		$this->controller->setParams($this->params);
		
	}
	
	private function setView(){
		$class = '\views\\' . ucfirst($this->controllerName) . 'View';
		if(class_exists($class)){
			$this->view = new $class();
		}
		else{
			$this->view = new \core\AppView();
		}
		$this->controller->setView($this->view);
	}
	private function setModel(){
		$class = '\models\\' . ucfirst($this->controllerName) . 'Model';
		if(class_exists($class)){
			$this->model = new $class();
		}
		$this->model = null;
		$this->controller->setModel($this->model);
	}

	public function dispatch(){
		if(!method_exists($this->controller, $this->action)){
			throw new \Exception('Could not find action: ' . $this->action . ' in controller: ' . $this->controllerName);
		}
		
		$result = call_user_func(array($this->controller, $this->action));
		//$view = $this->controller->getView();
		if($result !== null){
			$this->layoutView->add('content', $result);
		}
		else{
			$content = $this->view->build($this->controllerName, $this->action);
			$this->layoutView->add('content', $content);
		}
		$this->layoutView->setScript($this->view->getScript());
		$this->layoutView->setCSS($this->view->getCSS());
		$this->render();
	}

	public function render(){
		try{
			$layoutHTML = $this->layoutView->render();
			echo $layoutHTML;
			exit;
		}
		catch(\Exception $e){
			return;
		}
	}
}