<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	public function index(){
		$categories = $this->Category->all();
		$this->view->setVar('categories', $categories);
	}

	public function view(){
		$category = $this->Category->first($this->params[0]);
		$products = $this->Category->Product->find($category->id, 'category_id');
		$this->view->setVar('category', $category);
		$this->view->setVar('products', $products);
	}
}