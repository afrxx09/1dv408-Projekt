<?php

class View{
	
	protected $vars = array();

	public function setVar($key, $value){
		$this->vars[$key] = $value;
	}

	public function build($controller, $action){
		$file = ROOT_DIR . 'app' . DS . 'views' . DS . $controller . DS . $action . '.php';
		return $this->evaluate($file, $this->vars);
	}

	public function evaluate($viewFile, $viewData = array()){
		extract($viewData);
		ob_start();
		include($viewFile);
		return ob_get_clean();
	}
}