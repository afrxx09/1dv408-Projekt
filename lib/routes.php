<?php

class Routes{

	/**
	*	Routing table for application.
	*	Specify what routes are available in the application.
	*	@example '' (empty string) creates a routes to root folder and runs DEFAULT_CONTROLLER with DEFAULT_ACTION from config.php
	*	@example 'controller#action' path for a controller and specific action
	*	@example 'all' creates routes to all default(CRUD) actions on a controller
	*	@example array('action1', 'action2', ..) specify a list of actions on a controller
	*/
	private static $routes = array(
		'root' => '',
		'start' => 'welcome#start',
		'category' => 'all',
		'product' => array('view', 'add', 'create')
	);
	
	/**
	*	Standard setup of actions for a controller
	*/
	private static $standardRoutes = array(
		'index' => '',
		'view' => 'view/{id}/',
		'add' => 'add/',
		'create' => 'create/',
		'edit' => 'edit/{id}/',
		'save' => 'save/',
		'delete' => 'delete/{id}/'
	);

	/**
	*	Creates a relative url-path from available routes if it's found in the $routes array
	*	@param string $route, name of route
	*	@param array $param, array of parameters for paths that needs it 
	*	@return string, relative url-path
	*/
	public static function getRoute($route, $param = array()){
		$route = explode('#', $route);
		$routeName = $route[0];
		$routeAction = isset($route[1]) ? $route[1] : \Config::DEFAULT_ACTION;

		if(!array_key_exists($routeName, self::$routes)){
			throw new \Exception('Route does not exsist: ' . $routeName);
		}
		$routes = self::$routes[$routeName];

		/** If route is in controller#action format */
		if(is_string($routes) && $routes !== 'all'){
			$p = explode('#', $routes);
			$controller = $p[0];
			$action = isset($p[1]) ? $p[1] . '/' : null;
			return rtrim(ROOT_PATH . $controller . '/' . $action, '/') . '/';
		}

		/** Validate that standard or specific rout from list exists */
		if( (is_string($routes) && $routes === 'all' ) && (!array_key_exists($routeAction, self::$standardRoutes)) ){
			throw new \Exception('Route does not exsist: ' . $routeName . '#' . $routeAction);
		}

		if(is_array($routes) && ($routeAction === null || !in_array($routeAction, $routes)) ){
			throw new \Exception('Route does not exsist: ' . $routeName . '#' . $routeAction);
		}

		$action = self::$standardRoutes[$routeAction];
		if(stripos($action, '{') !== false && empty($param)){
			throw new \Exception('Action: ' . $routeAction . ' in controller: ' . $routeName . ' requires a parameter.');
		}
		if(!empty($param)){
			$action = str_replace('{' . key($param) . '}', current($param), $action);
		}
		return rtrim(ROOT_PATH . $routeName . '/' . $action, '/') . '/';
	}

	public static function match($controller, $action, $params){

		if(!array_key_exists($controller, self::$routes)){
			throw new \Exception('No routes for: ' . $controller);
		}
		$routes = self::$routes[$controller];
		if( (is_string($routes) && $routes !== 'all') && stripos($routes, '#') < 0){

		}
		if(is_array($routes) && !in_array($action, $routes)){
			throw new \Exception('No route for action: ' . $action . ' in controller: ' . $controller);
		}
		if( (is_string($routes) && $routes === 'all' ) && ( !array_key_exists($action, self::$standardRoutes)) ){
			throw new \Exception('No route for action: ' . $action . ' in controller: ' . $controller);
		}

		$actionRoute = self::$standardRoutes[$action];
		if(stripos($actionRoute, '{') > 0 && empty($params)){
			throw new \Exception('Action: ' . $action . ' in controller: ' . $controller . ' requires a parameter.');
		}
	}
}