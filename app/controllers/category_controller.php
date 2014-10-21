<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	public function index(){
		$categories = $this->model->getCategories();
		$this->view->setVar('categories', $categories);
	}

	public function view(){
		return $this->view->view($this->params[0]);
	}

	public function edit(){
		
	}
}