<?php

/**
*	Base View class
*	Polymorphed into appliaction view-classes and also the layoutView class that renders the full HTML document.
*	keeps track of data needed for rendering and also handles $_POST
*/
class View{
	
	protected $vars = array();
	protected $appJavascript = array();
	protected $javascript = array();
	protected $appCss = array();
	protected $css = array();
	protected $model;
	
	/**
	*	Sets variables for view-files before rendering them
	*	@param string $key, name of variable
	*	@param mixed $value, data for variable
	*/
	public function setVar($key, $value){
		$this->vars[$key] = $value;
	}

	/**
	*	This function builds a dir_path to a view-file based on the current controller and action.
	*	It then asks the evaluate function to interpret the file and return the content as a string
	*	@param string $dir, name of controller to find the coirrect directory for the view file
	*	@param string $file, name of the action to find the correct file to render
	*	@return string, content of evaluated view-file
	*/
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

	/**
	*	Extracts view-variables to make them accessable to the view file.
	*	Starts output with ob_start, includes the view file wich is being renderd as a regular php-file using the exported variables
	*	ob_get_clean clears the output and returns all that output as a string.
	*	@param string $viewFile, full path to the view file
	*	@param array $viewData, array containing all the data used by the view file, if any.
	*/
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
	
	/** Used by layoutView class to get all javascript files needed for current request */
	public function getScript(){
		return array_merge($this->appJavascript, $this->javascript);
	}
	
	/** Used by layoutView class to get all css files needed for current request */
	public function getCSS(){
		return array_merge($this->appCss, $this->css);
	}
	
	/** Basic cleanup of $_POST-variable */
	protected function sanitize($input) {
        return filter_var(trim($input), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }
    
    public function setModel($model){
    	$this->model = $model;
    }

    /**  
    *	Method to access the $_POST-variable by controller classes.
    *	Can be retreived as either clean $_POST array or as a stdClass-object
    *	@param bool $getClean, get unmodified clean $_POST variable
    *	@return mixed, either unmodified $_POST array, or $_POST turned into stdClass-object
    *	but mainly used to get stdClass-objects filterd through a model's allowedfields
    */
	public function getPost($getClean = false){
		if(isset($this->allowedFields) && !empty($this->allowedFields) && $getClean === false){
			$return = array();
			foreach($_POST as $key => $post){
				if(in_array($key, $this->allowedFields)){
					$return[$key] = $this->sanitize($post);
				}
			}
			return (object)$return;
		}
		elseif($getClean !== true){
			return (object)$_POST;
		}
		else{
			return $_POST;
		}
	}
}