<?php
namespace controllers;

class CategoryController extends \core\AppController{
	
	protected $helpers = array('Session');

	public function index(){
		$categories = $this->Category->all();
		$this->view->setVar('categories', $categories);
		$this->view->setVar('flash', $this->Session->renderFlash());
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
		if($this->Category->create($newCategory)){
			$this->Session->setFlash('category created : ' . $newCategory->name, 'success');
			$this->redirectTo('category');
		}
		$this->Session->setFlash('Could not create category', 'error');
		$this->redirectTo('category', 'add');
	}
	
	public function edit(){
		$category = $this->Category->one($this->params[0]);
		if($category === null){
			$this->redirectTo('category');
		}
		$this->view->setVar('category', $category);

	}
	
	public function save(){
		$category = $this->view->getPost();
		if($this->Category->save($category)){
			$this->Session->setFlash('category saved : ' . $category->name, 'success');
			$this->redirectTo('category' ,'view', $category->id);
		}
		$this->Session->setFlash('Could not save category', 'error');
		$this->redirectTo('category', 'edit', $category->id);
	}
	
	public function delete(){
		$category = $this->Category->one($this->params[0]);
		if($category !== null && $this->Category->delete($category)){
			$this->Session->setFlash('Successfully Deleted category : ' . $category->name, 'success');
		}
		else{
			$this->Session->setFlash('Could not find category id: ' . $this->params[0], 'error');
		}
		$this->redirectTo('category');
	}
}