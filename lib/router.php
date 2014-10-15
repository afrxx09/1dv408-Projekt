<?php

class Router{
	private $url;
	private $controller;
	private $action;
	private $params = array();

	private $layoutView;

	public function __construct(LayoutView $layoutView){
		$this->layoutView = $layoutView;
		$this->getURL();
		$this->parseURL();

		/** Check to see if the request is in the routes table */
		\Routes::match($this->controller, $this->action, $this->params);
	}

	private function getURL(){
		$url = isset($_GET['url']) ? $_GET['url'] : '';
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$this->url = $url;
	} 

	private function parseURL(){
		$route = explode('/', $this->url);
		$this->controller = (!empty($route[0])) ? $route[0]: \Config::DEFAULT_CONTROLLER;
		$this->action = (!empty($route[1])) ? $route[1]: \Config::DEFAULT_ACTION;
		for($i = 2; $i < count($route); $i ++){
			$this->params[] = $route[$i];
		}
	}

	public function dispatch(){
		$className = '\controllers\\' . ucfirst($this->controller) . 'Controller';
		if(class_exists($className)){
			$controller = new $className();
			$controller->setParams($this->params);
			if(method_exists($controller, $this->action)){
				$result = call_user_func(array($controller, $this->action));
				if($result !== null){
					$this->layoutView->add('content', $result);
				}
				else{
					$view = $controller->getView();
					$content = $view->build($this->controller, $this->action);
					$this->layoutView->add('content', $content);
					//$content = $this->layoutView->build($this->controller, $this->action, $controller->getViewVars());
					//$this->layoutView->add('content', $content);
				}	
				$this->render();
			}
			throw new \Exception('Could not find action: ' . $this->action . ' in controller: ' . $this->controller);
		}
		throw new \Exception('Could not find controller class: ' . $this->controller);
	}

	public function render(){
		echo $this->layoutView->render();
		exit;
	}
}