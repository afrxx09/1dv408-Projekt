<?php

class LayoutView extends \View{
	private $layoutPath;
	private $content = array();
	
	public function __construct(){
		$this->layoutPath = ROOT_DIR . 'app' . DS . 'layout' . DS;
	}
	
	public function get($key){
		return $this->content[$key];
	}
	
	public function add($key, $value){
		$this->content[$key] = $value;
	}
	
	public function partial($partial){
		return $this->evaluate($this->layoutPath . $partial . '.php');
	}
	
	public function render(){
		return $this->evaluate($this->layoutPath . 'default.php', array('this' => $this));
	}
}