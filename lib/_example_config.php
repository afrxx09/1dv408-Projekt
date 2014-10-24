<?php

define('APP_DIR', ROOT_DIR . 'app' . DS);
define('LAYOUT_DIR', APP_DIR . 'layout' . DS);
define('CONTROLLER_DIR', APP_DIR . 'controllers' . DS);
define('VIEW_DIR', APP_DIR . 'views' . DS);
define('MODEL_DIR', APP_DIR . 'models' . DS);
define('HELPER_DIR', ROOT_DIR . 'helpers' . DS);

class Config{
	const DEFAULT_LAYOUT = 'default.php';
	const DEFAULT_CONTROLLER = 'StaticPages';
	const DEFAULT_ACTION = 'index';

	const DB_PASSWORD = '';
	const DB_USERNAME = 'root';
	const DB_HOST = 'localhost';
	const DB_NAME = 'dbname';

	const DEBUG = true;
	const ERROR_LOG = "errors.log"; 
}