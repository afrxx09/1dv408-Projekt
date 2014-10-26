<?php

class Routing{
	
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
	*	Get controller and action for root path
	*	@return 
	*/
	public static function getRoot(){
		return isset(\Routes::$routes['root']) ? explode('#', \Routes::$routes['root']) : null;
	}

	/**
	*	Creates a relative url-path from available routes if it's found in the $routes array
	*	@param string $route, name of route
	*	@param array $param, array of parameters for paths that needs it 
	*	@return string, relative url-path
	*/
	public static function getRoute($request, $param = array()){
		if($request === 'root'){
			return ROOT_PATH;
		}
		/** Find route for named rutes or controller route */
		if(strpos($request, '#') === false && array_key_exists($request, \Routes::$routes)){
			/**
			*	Search for named route to a controller#action
			*	@example \Routes::getRoute('myRoute') would find: 'myroute' => 'aController#theAction' 
			*	@example \Routes::getRoute('myControler') would find: 'myController' => [anything] 
			*/
			if(is_string(\Routes::$routes[$request]) && \Routes::$routes[$request] !== 'all'){
				$route = explode('#', \Routes::$routes[$request]);
				$controller = $route[0];
				$action = isset($route[1]) ? $route[1] : '';

				if(stripos($action, '{') !== false){
					if(empty($param)){
						throw new \Exception('Action: "' . $action . '" in controller: "' . $controller . '" requires a parameter.');
					}
					$action = str_replace('{' . key($param) . '}', '/' . current($param), $action);
				}
				return rtrim(ROOT_PATH . $controller . '/' . $action, '/') . '/';
			}
			/**
			*	Search for controller route and exclude action to go to default action for that controller
			*/
			elseif(is_string(\Routes::$routes[$request]) || is_array(\Routes::$routes[$request])){
				return rtrim(ROOT_PATH . $request, '/') . '/';
			}
			throw new \Exception('Can not find named route or controller route:' . $request);
		}
		else{
			/**
			*	Search for controller and action
			*	@example 'myController' => 'all'
			*	@example 'myController' => array('delete', 'edit')
			*/
			$route = explode('#', $request);
			$controllerRequest = $route[0];
			$actionRequest = isset($route[1]) ? $route[1] : '';
			/** Make sure the controller exsists in raoutes array */
			if(array_key_exists($controllerRequest, \Routes::$routes)){
				$routeActions = \Routes::$routes[$controllerRequest];
				/** If the controller only has one action routed as a string that is not "all" */
				if(is_string($routeActions) && $routeActions !== 'all'){
					if($actionRequest !== $routeActions){
						throw new Exception('No route for action: "' . $actionRequest . '" in controller: "' . $controllerRequest . '"');
					}
				}
				/** If all is declared controller uses all default paths for basic CRUD */
				elseif(is_string($routeActions) && $routeActions === 'all'){
					if(!array_key_exists($actionRequest, self::$standardRoutes)){
						throw new Exception('Action: "' . $actionRequest . '" is not a declared route for controller: "' . $controllerRequest . '"');
					}
					$actionRequest = self::$standardRoutes[$actionRequest];
				}
				/** Searc for route in array of declared controller actions */
				elseif(is_array($routeActions) && !in_array($actionRequest, $routeActions)){
					$match = false;
					foreach($routeActions as $routeAction){
						if(stripos($routeAction, $actionRequest) !== false){
							$match = true; 
							$actionRequest = str_ireplace('{', '/{', $routeAction);
						}
					}
					if(!$match){
						throw new Exception('Action: "' . $actionRequest . '" is not a declared route for controller: "' . $controllerRequest . '"');
					}
				}
				/** Fix standard routes with paramters */
				if(stripos($actionRequest, '{') !== false){
					if(empty($param)){
						throw new \Exception('Action: "' . $actionRequest . '" in controller: "' . $controllerRequest . '" requires a parameter.');
					}
					$actionRequest = str_replace('{' . key($param) . '}', current($param), $actionRequest);
				}
			}
			return rtrim(ROOT_PATH . $controllerRequest . '/' . $actionRequest, '/') . '/';
			throw new \Exception('Can not find routes for controller: "' . $controllerRequest . '"');
		}
		throw new \Exception('Route does not exsist: "' . $request . '"');
	}
}