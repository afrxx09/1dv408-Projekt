<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	public function index(){
		/** try class inheritence from AppController */
		echo $this->asd();
	}

	public function edit($id){
		echo $id;
	}
}