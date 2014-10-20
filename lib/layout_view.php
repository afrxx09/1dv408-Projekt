<?php

class LayoutView extends \View{
	private $layoutPath;
	private $content = array('content' =>'', 'css' => '', 'script' => '');
	
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

	public function setScript($javascriptFiles){
		$js = '';
		foreach($javascriptFiles as $filename){
			$js .= '<script src="' . ROOT_PATH . 'pub/javascript/' . $filename . '" type="text/javascript"></script>' . "\n";
		}
		$this->add('script', $js);
	}

	public function setCSS($cssFiles){
		$css = '';
		foreach($cssFiles as $filename){
			$css .= '<link href="' . ROOT_PATH . 'pub/css/'. $filename . '" rel="stylesheet" type="text/css" />' . "\n";
		}
		$this->add('css', $css);
	}
}