<?php

class View{
	
	protected $vars = array();

	public function setVar($key, $value){
		$this->vars[$key] = $value;
	}

	public function build($controller, $action){
		$file = ROOT_DIR . 'app' . DS . 'views' . DS . $controller . DS . $action . '.php';
		if(file_exists($file)){
			return $this->evaluate($file, $this->vars);
		}
		throw new Exception('Could not not find view file for ' . $controller . ' # ' . $action );
	}

	public function evaluate($viewFile, $viewData = array()){
		extract($viewData);
		ob_start();
		include($viewFile);
		return ob_get_clean();
	}

	public function getScript(){
		return array_merge($this->app_javascript, $this->javascript);
	}
	public function getCSS(){
		return array_merge($this->app_css, $this->css);
	}
}