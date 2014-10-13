<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	public function index(){
		/** try class inheritence from AppController */
		//echo $this->asd();
		echo 'category index';
	}

	public function view(){
		echo $this->params[0];
	}

	public function edit(){
		echo $this->params[0];
	}
}