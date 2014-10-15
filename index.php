<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', '/' . basename(dirname(__FILE__)) . '/');

require_once(ROOT_DIR . 'lib' . DS . 'autoload.php');

try{
	$layoutView = new layoutView();
	$router = new Router($layoutView);
	$router->dispatch();
}
catch(\Exception $e){
	if(\Config::DEBUG){
		var_dump($e);
	}
	else{
		echo 'Unknown error. Please try again.';
		error_log(serialize($e) . "\n", 3, ROOT_DIR . \CONFIG::ERROR_LOG);
	}
}