<?php

class Routes extends \Routing{
	/**
	*	Routing table for application.
	*	Specify what routes are available in the application.
	*	@example 'root' => 'controller#action', decides what controller and action to call for root request
	*	@example 'controller#action' path for a controller and specific action
	*	@example 'all' creates routes to all default(CRUD) actions on a controller
	*	@example array('action1', 'action2', ..) specify a list of actions on a controller
	*/
	public static $routes = array(
		'root' => 'pages#start',
		'test' => 'pages#test{id}',
		'testtwo' => 'pages',
		'pages' => array('start', 'contact'),
		'category' => 'all',
		'product' => array('view{id}', 'add', 'create')
	);
}