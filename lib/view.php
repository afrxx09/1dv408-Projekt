<?php

class View{
	
	protected $vars = array();
	protected $app_javascript = array();
	protected $javascript = array();
	protected $app_css = array();
	protected $css = array();

	public function setVar($key, $value){
		$this->vars[$key] = $value;
	}

	public function build($dir, $file){
		$dir = lcfirst($dir);
		preg_match_all( '/[A-Z]/', $dir, $matches, PREG_OFFSET_CAPTURE );
		if(!empty($matches)){
			for($i=0; $i < count($matches[0]); $i++){
				if(!empty($matches[0][$i])){
					$m = $matches[0][$i];
					$dir = substr_replace($dir, '_' . strToLower($m[0]), $m[1] + $i, 1);
				}
			}
		}
		$filePath = ROOT_DIR . 'app' . DS . 'views' . DS . $dir . DS . $file . '.php';
		if(file_exists($filePath)){
			return $this->evaluate($filePath, $this->vars);
		}
		throw new Exception('Could not not find view file ' . $filePath);
	}

	public function evaluate($viewFile, $viewData = array()){
		try{
			extract($viewData);
			ob_start();
			include($viewFile);
			return ob_get_clean();
		}
		catch(\Exception $e){
			throw new Exception("Error Processing Request");
		}
	}

	public function getScript(){
		return array_merge($this->app_javascript, $this->javascript);
	}
	
	public function getCSS(){
		return array_merge($this->app_css, $this->css);
	}
	
	public function getPost(){
		$return = array();
		foreach($_POST as $key => $post){
			$return[$key] = $this->sanitize($post);
		}
		return $return;
	}
	
	protected function sanitize($input) {
        return filter_var(trim($input), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }
}