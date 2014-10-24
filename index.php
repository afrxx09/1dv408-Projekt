<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', '/' . basename(dirname(__FILE__)) . '/');

define('APP_DIR', ROOT_DIR . 'app' . DS);
define('LAYOUT_DIR', APP_DIR . 'layout' . DS);
define('CONTROLLER_DIR', APP_DIR . 'controllers' . DS);
define('VIEW_DIR', APP_DIR . 'views' . DS);
define('MODEL_DIR', APP_DIR . 'models' . DS);
define('HELPER_DIR', ROOT_DIR . 'helpers' . DS);

require_once(ROOT_DIR . 'lib' . DS . 'autoload.php');
require_once(ROOT_DIR . 'app' . DS . 'routes.php');

try{
	$layoutView = new layoutView();
	$dispatcher = new Dispatcher($layoutView);
	$dispatcher->dispatch();
}
catch(\Exception $e){
	if(\Config::DEBUG){
		error_reporting(E_ALL);
		var_dump($e);
	}
	else{
		error_reporting(0);
		echo 'Unknown error. Please try again.';
		error_log(serialize($e) . "\n", 3, ROOT_DIR . \CONFIG::ERROR_LOG);
	}
}