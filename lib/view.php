<?php

class View{
	
	public function evaluate($viewFile, $viewData = array()){
		extract($viewData);
		ob_start();
		include($viewFile);
		return ob_get_clean();
	}
}