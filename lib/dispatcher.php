<?php

/**
*	Dispatcher class, the engine of the application
*	Reads the request to detemine what controller, views and models to initiate.
*	Dispatches the request and uses layoutView class to render the result. 
*/
class Dispatcher{
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
		$this->setModel($this->controllerName);
	}
	
	/**
	*	Get the request and prepare it for parsing
	*/
	private function getURL(){
		$url = isset($_GET['url']) ? $_GET['url'] : '';
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$this->url = $url;
	} 
	
	/**
	*	Parse url to determine the main controller, it's action method and potential paramters for the request
	*/
	private function parseURL(){
		$route = explode('/', $this->url);
		$root = \Routes::getRoot();
		if(empty($route[0]) && $root !== null){
			$this->controllerName = ucFirst($root[0]);
			$this->action = isset($root[1]) ? $root[1] : \Config::DEFAULT_ACTION;
		}
		else{
			$this->controllerName = (!empty($route[0])) ? ucFirst($route[0]): \Config::DEFAULT_CONTROLLER;
			$this->action = (!empty($route[1])) ? $route[1]: \Config::DEFAULT_ACTION;
			for($i = 2; $i < count($route); $i ++){
				$this->params[] = $route[$i];
			}
		}
	}
	
	/**
	*	Initiate the main controller for the request and pass the parameters to it
	*/
	private function setController(){
		$class = '\controllers\\' . $this->controllerName . 'Controller';
		if(!class_exists($class)){
			throw new \Exception('Could not find controller class: ' . $class);
		}
		$this->controller = new $class();
		$this->controller->setParams($this->params);
	}
	
	/**
	*	Initiate the view-class that belongs to the controller. If there is no view-class created it will fall back on the base-class to be able to handle basic rendering
	*/
	private function setView(){
		$class = '\views\\' . $this->controllerName . 'View';
		if(class_exists($class)){
			$this->view = new $class();
		}
		else{
			$this->view = new \core\AppView();
		}
		$this->controller->setView($this->view);
	}
	
	/**
	*	Initiate the main model for the controller, also looking at associated model and initiating them into the main model
	*/
	private function setModel($controllerName){
		$class = '\models\\' . $controllerName . 'Model';
		if(class_exists($class)){
			$class = new $class($controllerName);
			$this->controller->{$controllerName} = $class;
			$this->view->setModel($class);
			
			$model = $this->controller->{$controllerName};
			$relations = array_merge($model->hasOne, $model->hasMany, $model->belongsTo);
			foreach($relations as $modelName){
				$class = '\models\\' . $modelName . 'Model';
				if(class_exists($class)){
					$class = new $class($modelName);
					$model->$modelName = $class;
				}
			}
		}
		else{
			$appModel = new \core\AppModel();
			$this->view->setModel($appModel);
		}
	}
	
	/**
	*	Execute the request.
	*	Runs the specified action-method in the controller and handles the response.
	*	A response from a controller class should either be a string that will be renderd in the layout.
	*	If the response is null, its presumed that a view-file should be used for rendering the content.
	*	Last, the layoutView asks the view for any declared css or javascript files that should be used in the renderd document
	*/
	public function dispatch(){
		if(!method_exists($this->controller, $this->action)){
			throw new \Exception('Could not find action: ' . $this->action . ' in controller: ' . $this->controllerName);
		}
		
		$result = call_user_func(array($this->controller, $this->action));
		
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
	
	/**
	*	Using the layoutView, renders the complete HTML document
	*/
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