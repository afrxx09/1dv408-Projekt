<?php

namespace controllers;

class PagesController extends \core\AppController{
	
	public function start(){
		return 'asd';	
	}

	public function test(){
		$test = \Routes::getRoute('product#view', array('id' => 22));
		var_dump($test);

		exit;
	}

	public function contact(){
		return 'contact';
	}
}