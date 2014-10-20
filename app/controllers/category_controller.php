<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	public function index(){
		$categories  = array('Category 1', 'Category two', 'Category tre', 'Category yon');
		$this->view->setVar('categories', $categories);
	}

	public function view(){
		return $this->view->view($this->params[0]);
	}

	public function edit(){
		
	}
}