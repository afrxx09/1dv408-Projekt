<?php

/**
*	Static class to declare all routes for the application
*	Extends from base-class "Routing" to separate the list of routes from routing logic
*/
class Routes extends \Routing{
	/**
	*	Routing table for application.
	*	Specify what routes are available in the application.
	*	@example 'root' => 'controller#action', decides what controller and action to call for root request
	*	@example 'named_route' => 'controller#action' named route for a controller and specific action
	*	@example 'all' creates routes to all default(CRUD) actions on a controller
	*	@example 'controller' => array('action1', 'action2', ..) specify a list of actions on a controller
	*	@example 'param_route' => 'controller#action{id}' declares that route take a parameter
	*/
	public static $routes = array(
		'root' => 'pages#start',
		'test' => 'pages#test{id}',
		'testtwo' => 'pages',
		'pages' => array('start', 'contact'),
		'category' => 'all',
		'product' => 'all'
	);
}