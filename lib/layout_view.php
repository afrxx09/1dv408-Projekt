<?php

/**
*	LayoutView taked care of rendering HTML-document when a request is complete.
*	It uses the same principle for rendering the layout as the controller view files.
*	"$this" is accessable in the layout file and refers to this  LayoutView class.
*	This allows the rendering file to make method calls back into the class for dynamic rendering of content.
*/
class LayoutView extends \View{
	/** Default content variables for layout */
	private $content = array('content' =>'', 'css' => '', 'script' => '');
	
	/**
	*	Get renderd content for a content-variable in the layout
	*	@param string $key, variable name
	*	@return string, HTML code
	*/
	public function get($key){
		return $this->content[$key];
	}
	
	/**
	*	Add HTML content to a content-variable to be used for rendering
	*	@param string $key, content name
	*	@param string $value, HTML content
	*/
	public function add($key, $value){
		$this->content[$key] = $value;
	}
	
	/**
	*	Get renderd partial view file for the layout
	*	@param string $partial, name of partial to be added into the layout
	*	@return string, HTML from renderd partial
	*/
	public function partial($partial){
		return $this->evaluate(LAYOUT_DIR . $partial . '.php');
	}
	
	/**
	*	Renders the complete HTML document using this class to access all data needed
	*	@return string HTML, the complete HTML document
	*/
	public function render(){
		return $this->evaluate(LAYOUT_DIR . \Config::DEFAULT_LAYOUT, array('this' => $this));
	}

	/**
	*	Builds all the javascript tags needed for the request and adds them to the content variable designated for javascript code
	*	@return string, HTML javascript tags
	*/
	public function setScript($javascriptFiles){
		$js = '';
		foreach($javascriptFiles as $filename){
			$js .= '<script src="' . ROOT_PATH . 'pub/javascript/' . $filename . '" type="text/javascript"></script>' . "\n";
		}
		$this->add('script', $js);
	}
	
	/**
	*	Builds all the css tags needed for the request and adds them to the content variable designated for css code
	*	@return string, HTML css tags
	*/
	public function setCSS($cssFiles){
		$css = '';
		foreach($cssFiles as $filename){
			$css .= '<link href="' . ROOT_PATH . 'pub/css/'. $filename . '" rel="stylesheet" type="text/css" />' . "\n";
		}
		$this->add('css', $css);
	}
}