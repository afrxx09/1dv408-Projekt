<?php

function AutoLoadClasses($class){
	$class = ltrim($class, '\\');

	if(strripos($class, '\\') !== false){
		$className = substr($class, strripos($class, '\\') + 1);
		$namespace = explode('\\', $class, -1);

		$dir = ROOT_DIR . 'app' . DS . strToLower(implode(DS, $namespace)) . DS;
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