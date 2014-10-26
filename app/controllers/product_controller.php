<?php
namespace controllers;

class ProductController extends \core\AppController{
	protected $helpers = array('Session');

	public function index(){
		$products = $this->Product->all();
		$this->view->setVar('products', $products);
	}
	
	public function view(){
		$product = $this->Product->one($this->params[0]);
		$this->view->setVar('product', $product);
	}
	
	public function add(){
		$categories = $this->Product->Category->all();
		$this->view->setVar('categories', $categories);
		$this->view->setVar('flash', $this->Session->renderFlash());
	}
	
	public function create(){
		$newProduct = $this->view->getPost();
		if($this->Product->create($newProduct)){
			$this->Session->setFlash('Product added', 'success');
			$this->redirectTo('category', 'view', $newProduct->category_id);
		}
		$this->Session->setFlash('Could not add product', 'error');
		$this->redirectTo('product', 'add');
	}
	
	public function edit(){
		$product = $this->Product->one($this->params[0]);
		if($product === null){
			$this->redirectTo('product');
		}
		$this->view->setVar('product', $product);
	}
	
	public function save(){
		$product = $this->view->getPost();
		if($this->Product->save($product)){
			$this->redirectTo('product' ,'view', $product->id);
		}
		$this->redirectTo('product', 'edit', $product->id);
	}
	
	public function delete(){
		$product = $this->Product->one($this->params[0]);
		if($product !== null && $this->Product->delete($product)){
			$this->redirectTo('product');
		}
		return 'Could not delete product.';
	}
}