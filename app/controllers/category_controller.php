<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	public function index(){
		$categories = $this->Category->all();
		$this->view->setVar('categories', $categories);
	}

	public function view(){
		$category = $this->Category->one($this->params[0]);
		$products = $this->Category->Product->find($category->id, 'category_id');
		$this->view->setVar('category', $category);
		$this->view->setVar('products', $products);
	}
	
	public function add(){
		//empty
	}
	
	public function create(){
		$newCategory = $this->view->getPost();
		$this->Category->check($newCategory);
		if($this->Category->create($newCategory)){
			$this->redirectTo('category');
		}
		$this->redirectTo('category#add');
	}
	
	public function edit(){
		$category = $this->Category->one($this->params[0]);
		$this->view->setVar('category', $category);
	}
	
	public function save(){
		$category = $this->view->getPost();
		$this->Category->check($category);
		if($this->Category->save($category)){
			$this->redirectTo('category' ,'view', $category->id);
		}
		$this->redirectTo('category', 'edit', $category->id);
	}
	
	public function delete(){
		$category = $this->Category->one($this->params[0]);
		if($category !== null && $this->Category->delete($category)){
			$this->redirectTo('category');
		}
		return 'Could not delete category.';
	}
}