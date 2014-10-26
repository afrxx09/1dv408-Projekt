<?php

/**
*	requires class files based on namespace and class name.
*	Classes without namespace are presumed to be framwork files so they are include from lib-folder.
*	Other classes are found in app-folder and namespace decides what sub-folder.
*/
function AutoLoadClasses($class){
	$class = ltrim($class, '\\');

	if(strripos($class, '\\') !== false){
		$className = substr($class, strripos($class, '\\') + 1);
		$namespace = explode('\\', $class, -1);
		if(!in_array('helpers', $namespace)){
			$dir = APP_DIR . strToLower(implode(DS, $namespace)) . DS;
		}
		else{
			$dir = HELPER_DIR; 
		}
	}
	else{
		$className = $class;
		$dir = ROOT_DIR . 'lib' . DS;
	}

	$file = lcfirst($className);
	preg_match_all( '/[A-Z]/', $file, $matches, PREG_OFFSET_CAPTURE );
	if(!empty($matches)){
		for($i=0; $i < count($matches[0]); $i++){
			if(!empty($matches[0][$i])){
				$m = $matches[0][$i];
				$file = substr_replace($file, '_' . strToLower($m[0]), $m[1] + $i, 1);
			}
		}
	}
	$file = $file . '.php';
	if(file_exists($dir.$file)){
		require_once($dir.$file);
	}
}

spl_autoload_register('AutoLoadClasses');